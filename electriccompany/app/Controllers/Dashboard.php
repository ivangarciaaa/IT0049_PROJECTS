<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends BaseController
{
    private CustomerAccountModel $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    public function index()
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to open the dashboard.');
        }

        $keyword = trim((string) $this->request->getGet('search'));
        $status = (string) $this->request->getGet('status');
        $type = (string) $this->request->getGet('type');

        $allowedStatuses = ['active', 'inactive', 'suspended'];
        $allowedTypes = ['residential', 'commercial', 'industrial'];
        $status = in_array($status, $allowedStatuses, true) ? $status : '';
        $type = in_array($type, $allowedTypes, true) ? $type : '';

        return view('dashboard/index', [
            'title' => 'Customer Dashboard - Puihaha Electric',
            'page' => 'dashboard',
            'accounts' => $this->customerModel->getFilteredAccounts($keyword, $status, $type, 10),
            'pager' => $this->customerModel->pager,
            'totalAccounts' => $this->customerModel->getTotalAccounts(),
            'activeAccounts' => $this->customerModel->getCountByStatus('active'),
            'inactiveAccounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspendedAccounts' => $this->customerModel->getCountByStatus('suspended'),
            'searchKeyword' => $keyword,
            'filterStatus' => $status,
            'filterType' => $type,
            'displayName' => (string) session()->get('display_name'),
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function viewAccount(int $id)
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to view account details.');
        }

        $account = $this->findAccount($id);

        return view('dashboard/account', [
            'title' => 'Account Details - Puihaha Electric',
            'page' => 'dashboard',
            'account' => $account,
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function newAccount()
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to create an account.');
        }

        return view('dashboard/form', [
            'title' => 'Add Customer Account - Puihaha Electric',
            'page' => 'dashboard',
            'formTitle' => 'Add Customer Account',
            'formDescription' => 'Create a new electrical service account.',
            'formAction' => base_url('dashboard/account'),
            'submitLabel' => 'Create Account',
            'account' => [],
            'validation' => session()->getFlashdata('validation') ?? [],
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function createAccount()
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to create an account.');
        }

        $data = $this->accountData();
        $rules = $this->accountRules();

        if (! $this->validateData($data, $rules)) {
            return redirect()->to(base_url('dashboard/account/new'))
                ->withInput()->with('validation', $this->validator->getErrors());
        }

        try {
            $id = $this->customerModel->insert($data, true);
        } catch (\Throwable $e) {
            log_message('error', 'Customer account creation failed: {message}', ['message' => $e->getMessage()]);
            return redirect()->to(base_url('dashboard/account/new'))
                ->withInput()->with('error', 'The customer account could not be created.');
        }

        if ($id === false) {
            return redirect()->to(base_url('dashboard/account/new'))
                ->withInput()->with('validation', $this->customerModel->errors());
        }

        return redirect()->to(base_url('dashboard/account/' . $id))
            ->with('success', 'Customer account created successfully.');
    }

    public function editAccount(int $id)
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to edit an account.');
        }

        return view('dashboard/form', [
            'title' => 'Edit Customer Account - Puihaha Electric',
            'page' => 'dashboard',
            'formTitle' => 'Edit Customer Account',
            'formDescription' => 'Update the customer and electrical service details.',
            'formAction' => base_url('dashboard/account/' . $id . '/update'),
            'submitLabel' => 'Save Changes',
            'account' => $this->findAccount($id),
            'validation' => session()->getFlashdata('validation') ?? [],
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function updateAccount(int $id)
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to edit an account.');
        }

        $this->findAccount($id);
        $data = $this->accountData();
        $rules = $this->accountRules($id);

        if (! $this->validateData($data, $rules)) {
            return redirect()->to(base_url('dashboard/account/' . $id . '/edit'))
                ->withInput()->with('validation', $this->validator->getErrors());
        }

        try {
            $updated = $this->customerModel->update($id, $data);
        } catch (\Throwable $e) {
            log_message('error', 'Customer account update failed: {message}', ['message' => $e->getMessage()]);
            return redirect()->to(base_url('dashboard/account/' . $id . '/edit'))
                ->withInput()->with('error', 'The customer account could not be updated.');
        }

        if (! $updated) {
            return redirect()->to(base_url('dashboard/account/' . $id . '/edit'))
                ->withInput()->with('validation', $this->customerModel->errors());
        }

        return redirect()->to(base_url('dashboard/account/' . $id))
            ->with('success', 'Customer account updated successfully.');
    }

    public function deleteAccount(int $id)
    {
        if (! $this->isAuthenticated()) {
            return $this->loginRedirect('Please log in to delete an account.');
        }

        $account = $this->findAccount($id);

        try {
            $deleted = $this->customerModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Customer account deletion failed: {message}', ['message' => $e->getMessage()]);
            return redirect()->to(base_url('dashboard'))->with('error', 'The customer account could not be deleted.');
        }

        if (! $deleted) {
            return redirect()->to(base_url('dashboard'))->with('error', 'The customer account could not be deleted.');
        }

        return redirect()->to(base_url('dashboard'))
            ->with('success', 'Account ' . $account['account_number'] . ' was deleted successfully.');
    }

    private function isAuthenticated(): bool
    {
        return session()->get('is_logged_in') === true;
    }

    private function loginRedirect(string $message)
    {
        return redirect()->to(base_url('login'))->with('error', $message);
    }

    private function findAccount(int $id): array
    {
        $account = $this->customerModel->find($id);

        if ($account === null) {
            throw PageNotFoundException::forPageNotFound('Customer account not found.');
        }

        return $account;
    }

    private function accountData(): array
    {
        return [
            'account_number' => strtoupper(trim((string) $this->request->getPost('account_number'))),
            'customer_name' => trim((string) $this->request->getPost('customer_name')),
            'address' => trim((string) $this->request->getPost('address')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'email' => strtolower(trim((string) $this->request->getPost('email'))),
            'meter_number' => strtoupper(trim((string) $this->request->getPost('meter_number'))),
            'connection_type' => (string) $this->request->getPost('connection_type'),
            'status' => (string) $this->request->getPost('status'),
        ];
    }

    private function accountRules(?int $ignoreId = null): array
    {
        $uniqueRule = 'is_unique[customer_accounts.account_number]';
        if ($ignoreId !== null) {
            $uniqueRule = 'is_unique[customer_accounts.account_number,id,' . $ignoreId . ']';
        }

        return [
            'account_number' => 'required|max_length[50]|' . $uniqueRule,
            'customer_name' => 'required|min_length[2]|max_length[150]',
            'address' => 'required|min_length[5]|max_length[500]',
            'phone' => 'permit_empty|max_length[20]',
            'email' => 'permit_empty|valid_email|max_length[100]',
            'meter_number' => 'permit_empty|max_length[50]',
            'connection_type' => 'required|in_list[residential,commercial,industrial]',
            'status' => 'required|in_list[active,inactive,suspended]',
        ];
    }
}

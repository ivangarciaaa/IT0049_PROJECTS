<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('is_logged_in') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('login', [
            'title' => 'Login - Puihaha Electric',
            'page' => 'login',
            'error' => session()->getFlashdata('error'),
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function authenticate()
    {
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        if (! $this->validateData(
            ['email' => $email, 'password' => $password],
            ['email' => 'required|valid_email', 'password' => 'required']
        )) {
            return redirect()->to(base_url('login'))->withInput()->with(
                'error',
                'A valid email address and password are required.'
            );
        }

        $user = (new User())->findByEmail($email);

        if ($user === null || ! (bool) $user['is_active'] || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
        }

        $displayName = trim($user['first_name'] . ' ' . $user['last_name']);
        $this->startSession((int) $user['id'], $displayName, (string) $user['user_type']);

        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        session()->remove([
            'is_logged_in',
            'user_id',
            'display_name',
            'user_role',
        ]);
        session()->regenerate(true);

        return redirect()->to(base_url('login'))->with('success', 'You have been logged out.');
    }

    private function startSession(int $userId, string $displayName, string $role): void
    {
        session()->regenerate(true);
        session()->set([
            'is_logged_in' => true,
            'user_id' => $userId,
            'display_name' => $displayName,
            'user_role' => $role,
        ]);
    }
}

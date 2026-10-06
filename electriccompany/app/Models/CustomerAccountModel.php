<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerAccountModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'account_number',
        'customer_name',
        'address',
        'phone',
        'email',
        'meter_number',
        'connection_type',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getFilteredAccounts(
        string $keyword = '',
        string $status = '',
        string $type = '',
        int $perPage = 10
    ): array {
        if ($keyword !== '') {
            $this->groupStart()
                ->like('account_number', $keyword)
                ->orLike('customer_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->groupEnd();
        }

        if ($status !== '') {
            $this->where('status', $status);
        }

        if ($type !== '') {
            $this->where('connection_type', $type);
        }

        return $this->orderBy('id', 'ASC')->paginate($perPage);
    }

    public function getTotalAccounts(): int
    {
        return $this->countAllResults();
    }

    public function getCountByStatus(string $status): int
    {
        return $this->where('status', $status)->countAllResults();
    }
}

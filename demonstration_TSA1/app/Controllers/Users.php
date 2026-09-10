<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin01', 'full_name' => 'James Frondarina', 'role' => 'Administrator'],
            ['username' => 'manager01', 'full_name' => 'Andrea Cruz', 'role' => 'Store Manager'],
            ['username' => 'cashier01', 'full_name' => 'Paolo Garcia', 'role' => 'Cashier'],
            ['username' => 'cashier02', 'full_name' => 'Bianca Ramos', 'role' => 'Cashier'],
            ['username' => 'stock01', 'full_name' => 'Nathan Lim', 'role' => 'Inventory Staff'],
        ];

        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $users,
        ]);
    }
}

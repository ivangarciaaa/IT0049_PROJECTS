<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            ['full_name' => 'Angela Reyes', 'email' => 'angela.reyes@example.com', 'phone' => '0917 234 8101'],
            ['full_name' => 'Carlo Mendoza', 'email' => 'carlo.mendoza@example.com', 'phone' => '0918 512 3476'],
            ['full_name' => 'Denise Santos', 'email' => 'denise.santos@example.com', 'phone' => '0920 663 1298'],
            ['full_name' => 'Miguel Navarro', 'email' => 'miguel.navarro@example.com', 'phone' => '0921 775 4302'],
            ['full_name' => 'Sophia Villanueva', 'email' => 'sophia.v@example.com', 'phone' => '0922 846 9510'],
        ];

        return view('customers/index', [
            'title'     => 'Customer Accounts',
            'customers' => $customers,
        ]);
    }
}

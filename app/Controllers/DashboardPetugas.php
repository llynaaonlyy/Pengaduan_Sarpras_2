<?php

namespace App\Controllers;

class DashboardPetugas extends BaseController
{
    public function index()
    {
        $session = session();

        $user = [
            'username' => $session->get('username'),
            'role' => $session->get('role')
        ];

        return view('dashboard_petugas', ['user' => $user]);
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'isi'   => 'admin/v_dashboard'
        ];
        return view('admin/v_dashboard', $data);
    }
}

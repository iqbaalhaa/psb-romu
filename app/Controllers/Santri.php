<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Santri extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Santri',
            'isi'   => 'santri/v_dashboard'
        ];
        return view('santri/v_dashboard', $data);
    }
}

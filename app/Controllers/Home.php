<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Penerimaan Santri Baru ROMU',
            'subtitle' => 'Home',
            'validation' => \Config\Services::validation()
        ];
        return view('v_home', $data);
    }
}

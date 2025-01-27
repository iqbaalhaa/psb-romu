<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAuth;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->ModelAuth = new ModelAuth();
        $this->session = session();
    }

    public function index()
    {
        //
    }

    public function CekLogin()
    {
        // Validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Format email tidak valid!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan', $validation->getErrors());
            return redirect()->to(base_url());
        }

        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));

        $cek = $this->ModelAuth->CekLogin($email, $password);

        if ($cek) {
            if ($cek['is_active'] == '0') {
                session()->setFlashdata('pesan', 'Akun anda tidak aktif!');
                return redirect()->to(base_url());
            }

            $ses_data = [
                'id_user' => $cek['id_user'],
                'nama_user' => $cek['nama_user'],
                'email' => $cek['email'],
                'level' => $cek['level'],
                'foto' => $cek['foto'],
                'logged_in' => TRUE
            ];
            $this->session->set($ses_data);

            if ($cek['level'] == 'admin') {
                return redirect()->to(base_url('Admin'));
            } else {
                return redirect()->to(base_url('Santri'));
            }
        }

        session()->setFlashdata('pesan', 'Email atau Password salah!');
        return redirect()->to(base_url());
    }

    public function Logout()
    {
        $this->session->destroy();
        session()->setFlashdata('pesan', 'Berhasil logout!');
        return redirect()->to(base_url());
    }
}

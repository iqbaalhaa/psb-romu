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
        if (!$this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi!',
                    'valid_email' => '{field} Tidak Valid!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!'
                ]
            ]
        ])) {
            session()->setFlashdata('pesan', $this->validator->listErrors());
            return redirect()->back();
        }

        $email = $this->request->getPost('email');
        $password = md5($this->request->getPost('password'));

        $cek = $this->ModelAuth->CekLogin($email, $password);

        if ($cek) {
            if ($cek['is_active'] == '0') {
                session()->setFlashdata('pesan', 'Akun anda tidak aktif!');
                return redirect()->to(base_url());
            }

            // Ambil data santri jika user adalah santri
            $santri_data = null;
            if ($cek['level'] == 'santri') {
                $santri_data = $this->ModelAuth->getSantriData($cek['id_user']);
            }

            $ses_data = [
                'id_user' => $cek['id_user'],
                'nama_user' => $cek['nama_user'],
                'email' => $cek['email'],
                'level' => $cek['level'],
                'foto' => $cek['foto'],
                // Data tambahan untuk santri
                'id_santri' => $santri_data ? $santri_data['id_santri'] : null,
                'no_pendaftaran' => $santri_data ? $santri_data['no_pendaftaran'] : null,
                'status_pembayaran' => $santri_data ? $santri_data['status_pembayaran'] : null,
                'status_berkas' => $santri_data ? $santri_data['status_berkas'] : null,
                'logged_in' => TRUE
            ];
            $this->session->set($ses_data);

            // Debug: Log session data
            log_message('info', 'Session data after login: ' . json_encode($ses_data));

            if ($cek['level'] == 'admin') {
                return redirect()->to(base_url('Admin'));
            } else {
                return redirect()->to(base_url('Santri'));
            }
        }

        session()->setFlashdata('pesan', 'Email atau Password Salah!');
        return redirect()->back();
    }

    public function LogoutAdmin()
    {
        // Hapus session
        $session = session();
        $session->remove(['id_user', 'nama_user', 'email', 'level', 'foto']);
        $session->setFlashdata('pesan', [
            'icon' => 'error', // Menggunakan ikon error untuk logout
            'title' => 'Logout Berhasil!',
            'text' => 'Anda berhasil logout.'
        ]);
        return redirect()->to(base_url());
    }

    public function LogoutUser()
    {
        // Hapus session
        $session = session();
        $session->remove(['id_user', 'nama_user', 'email', 'level', 'foto']);
        $session->setFlashdata('pesan', [
            'icon' => 'error', // Menggunakan ikon error untuk logout
            'title' => 'Logout Berhasil!',
            'text' => 'Anda berhasil logout.'
        ]);
        return redirect()->to(base_url());
    }
}

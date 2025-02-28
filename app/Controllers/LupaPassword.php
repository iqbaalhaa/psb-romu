<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use CodeIgniter\Controller;

class LupaPassword extends BaseController
{
    protected $modelAuth;
    protected $email;

    public function __construct()
    {
        $this->modelAuth = new ModelAuth();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $data = [
            'title' => 'Lupa Password',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/v_lupa_password', $data);
    }

    public function prosesLupaPassword()
    {
        // Validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $email = $this->request->getPost('email');
        
        // Debug: tampilkan email yang dicari
        log_message('debug', 'Searching for email: ' . $email);
        
        $user = $this->modelAuth->getUserByEmail($email);
        
        // Debug: tampilkan hasil pencarian user
        log_message('debug', 'User found: ' . print_r($user, true));

        if ($user) {
            // Generate token reset password
            $token = bin2hex(random_bytes(32));
            $token_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Simpan token ke database
            $this->modelAuth->updateResetToken($user['id_user'], $token);

            // Konfigurasi email
            $this->email->setFrom('noreply@pesantren.com', 'Pesantren');
            $this->email->setTo($email);
            $this->email->setSubject('Reset Password');
            
            $message = "Silakan klik link berikut untuk mereset password Anda:\n\n";
            $message .= base_url("lupapassword/reset/$token");
            $message .= "\n\nLink ini akan kadaluarsa dalam 1 jam.";
            
            $this->email->setMessage($message);

            if ($this->email->send()) {
                session()->setFlashdata('success', 'Link reset password telah dikirim ke email Anda');
                return redirect()->to(base_url());
            } else {
                log_message('error', 'Email error: ' . $this->email->printDebugger(['headers']));
                session()->setFlashdata('error', 'Gagal mengirim email reset password');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Email tidak terdaftar dalam sistem');
            return redirect()->back()->withInput();
        }
    }

    public function reset($token)
    {
        $user = $this->modelAuth->getUserByResetToken($token);

        if (!$user) {
            session()->setFlashdata('error', 'Token tidak valid');
            return redirect()->to(base_url());
        }

        if (strtotime($user['reset_token_expires']) < time()) {
            session()->setFlashdata('error', 'Token sudah kadaluarsa');
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'Reset Password',
            'token' => $token,
            'validation' => \Config\Services::validation()
        ];
        return view('auth/v_reset_password', $data);
    }

    public function prosesResetPassword()
    {
        // Validasi input
        if (!$this->validate([
            'token' => 'required',
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $token = $this->request->getPost('token');
        $password = md5($this->request->getPost('password'));

        $user = $this->modelAuth->getUserByResetToken($token);

        if ($user) {
            $this->modelAuth->resetPassword($user['id_user'], $password);
            session()->setFlashdata('success', 'Password berhasil direset');
            return redirect()->to(base_url());
        } else {
            session()->setFlashdata('error', 'Token tidak valid');
            return redirect()->to(base_url());
        }
    }
} 
<?php

namespace App\Controllers;

use App\Models\M_Pendaftaran;

class Pendaftaran extends BaseController
{
    protected $M_Pendaftaran;

    public function __construct()
    {
        $this->M_Pendaftaran = new M_Pendaftaran();
    }

    private function uploadFoto()
    {
        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('foto/santri', $newName);
            return $newName;
        }
        return 'default.jpg';
    }

    private function simpanPendaftaran($jenjang)
    {
        // Validasi input
        $rules = [
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => 'required|min_length[6]',
            'nisn' => [
                'rules' => 'required|numeric|is_unique[tbl_santri.nisn]',
                'errors' => [
                    'is_unique' => 'NISN sudah terdaftar'
                ]
            ],
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_hp' => 'required|numeric',
            'asal_sekolah' => 'required',
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto harus diupload',
                    'max_size' => 'Ukuran foto maksimal 1MB',
                    'mime_in' => 'Format foto harus JPG/PNG'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('pesan', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // Upload foto
        $foto = $this->uploadFoto();

        // Data untuk tabel user
        $data_user = [
            'nama_user' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'level' => 'santri',
            'jenjang' => $jenjang,
            'foto' => $foto
        ];

        // Data untuk tabel santri
        $data_santri = [
            'nisn' => $this->request->getPost('nisn'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_hp' => $this->request->getPost('no_hp'),
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
            'jenjang' => $jenjang
        ];

        if ($this->M_Pendaftaran->simpanPendaftaran($data_user, $data_santri)) {
            session()->setFlashdata('success', 'Pendaftaran berhasil! Silahkan login untuk melengkapi data.');
            return redirect()->to(base_url());
        } else {
            session()->setFlashdata('pesan', 'Terjadi kesalahan saat mendaftar. Silahkan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    public function SimpanMTs()
    {
        return $this->simpanPendaftaran('MTs');
    }

    public function SimpanMA()
    {
        return $this->simpanPendaftaran('MA');
    }
}

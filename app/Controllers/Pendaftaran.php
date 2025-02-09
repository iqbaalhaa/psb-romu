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
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/foto/santri', $newName);
            return $newName;
        }
        return 'default.jpg';
    }

    private function simpanPendaftaran($jenjang)
    {
        try {
            // Mulai transaksi database
            $db = \Config\Database::connect();
            $db->transStart();

            // Log data yang diterima
            log_message('info', 'Memproses pendaftaran untuk jenjang: ' . $jenjang);
            log_message('info', 'Data POST: ' . json_encode($this->request->getPost()));

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
                session()->setFlashdata('pesan', [
                    'icon' => 'error',
                    'title' => 'Validasi Gagal!',
                    'text' => $this->validator->listErrors()
                ]);
                return redirect()->back()->withInput();
            }

            // Upload foto
            $foto = $this->uploadFoto();
            log_message('info', 'Hasil upload foto: ' . $foto);

            // Generate nomor pendaftaran
            $tahun = date('Y');
            $no_urut = str_pad($this->M_Pendaftaran->getLastId() + 1, 4, '0', STR_PAD_LEFT);
            $no_pendaftaran = $jenjang . '-' . $tahun . '-' . $no_urut;
            log_message('info', 'Nomor pendaftaran generated: ' . $no_pendaftaran);

            // Data untuk tabel user
            $data_user = [
                'nama_user' => $this->request->getPost('nama_lengkap'),
                'email' => $this->request->getPost('email'),
                'password' => md5($this->request->getPost('password')),
                'level' => 'santri',
                'jenjang' => $jenjang,
                'foto' => $foto
            ];
            log_message('info', 'Data user yang akan disimpan: ' . json_encode($data_user));

            // Simpan user dan dapatkan id_user
            $id_user = $this->M_Pendaftaran->insertUser($data_user);
            log_message('info', 'ID User yang didapat: ' . $id_user);

            // Data untuk tabel santri
            $data_santri = [
                'id_user' => $id_user,
                'no_pendaftaran' => $no_pendaftaran,
                'nisn' => $this->request->getPost('nisn'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'asal_sekolah' => $this->request->getPost('asal_sekolah'),
                'jenjang' => $jenjang,
                'tahun_daftar' => date('Y')
            ];
            log_message('info', 'Data santri yang akan disimpan: ' . json_encode($data_santri));

            // Simpan data santri
            $result_santri = $this->M_Pendaftaran->insertSantri($data_santri);
            log_message('info', 'Hasil simpan santri: ' . ($result_santri ? 'success' : 'failed'));

            // Commit transaksi
            $db->transComplete();

            if ($db->transStatus() === false) {
                log_message('error', 'Transaksi gagal');
                $db->transRollback();
                session()->setFlashdata('pesan', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Terjadi kesalahan saat mendaftar. Silahkan coba lagi.'
                ]);
                return redirect()->back()->withInput();
            }

            log_message('info', 'Transaksi berhasil');
            session()->setFlashdata('pesan', [
                'icon' => 'success',
                'title' => 'Pendaftaran Berhasil!',
                'text' => "Silahkan login menggunakan:\n\n".
                         "Email: ".$this->request->getPost('email')."\n".
                         "Password: (Password yang Anda daftarkan)\n\n".
                         "untuk melengkapi berkas pendaftaran."
            ]);
            return redirect()->to(base_url());

        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            session()->setFlashdata('pesan', [
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan sistem. Silahkan coba lagi nanti.'
            ]);
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

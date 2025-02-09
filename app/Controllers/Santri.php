<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Santri;
use App\Models\ModelSantri;
use App\Models\M_Pengumuman;
use App\Models\M_DetailSantri;

class Santri extends BaseController
{
    protected $M_Santri;
    protected $PengumumanModel;
    protected $session;
    protected $M_DetailSantri;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_Santri = new M_Santri();
        $this->PengumumanModel = new M_Pengumuman();
        $this->M_DetailSantri = new M_DetailSantri();
        $this->db = \Config\Database::connect();
        helper(['form', 'url']);
    }

    public function index()
    {
        $id_santri = session()->get('id_santri');

        // Hitung persentase kelengkapan berkas
        $persentase_berkas = $this->M_Santri->hitungPersentaseBerkas($id_santri);

        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard Santri',
            'santri' => $this->M_Santri->getSantriDetail($id_santri),
            'persentase_berkas' => round($persentase_berkas), // Bulatkan persentase
            'pengumuman' => $this->M_Santri->getPengumuman(),
            'jumlah_pengumuman' => $this->M_Santri->countPengumuman()
        ];

        return view('santri/v_dashboard', $data);
    }

    public function BiodataSantri()
    {
        $data = [
            'title' => 'Biodata Santri',
            'isi'   => 'santri/v_detail_santri'
        ];
        return view('santri/v_detail_santri', $data);
    }

    public function Pembayaran()
    {
        $id_santri = session()->get('id_santri');
        $data = [
            'title' => 'Pembayaran',
            'pembayaran' => $this->M_Santri->getPembayaran($id_santri)
        ];
        return view('santri/v_pembayaran', $data);
    }

    public function uploadBuktiPembayaran()
    {
        $id_santri = session()->get('id_santri');

        // Debug session
        log_message('info', 'Session Data: ' . json_encode(session()->get()));

        if (empty($id_santri)) {
            log_message('error', 'ID Santri tidak ditemukan di session');
            session()->setFlashdata('error', 'Sesi tidak valid, silahkan login ulang');
            return redirect()->to('Auth/Logout');
        }

        $validationRule = [
            'bukti_pembayaran' => [
                'label' => 'Bukti Pembayaran',
                'rules' => 'uploaded[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png]|max_size[bukti_pembayaran,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->getError('bukti_pembayaran'));
            return redirect()->to('Santri/Pembayaran');
        }

        try {
            $file = $this->request->getFile('bukti_pembayaran');
            $fileName = $file->getRandomName();

            // Pastikan direktori ada
            $uploadPath = FCPATH . 'bukti_pembayaran';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if (!$file->move($uploadPath, $fileName)) {
                throw new \Exception('Gagal mengupload file');
            }

            // Siapkan data pembayaran
            $data = [
                'id_santri' => $id_santri,
                'no_pendaftaran' => session()->get('no_pendaftaran'),
                'tgl_upload' => date('Y-m-d H:i:s'),
                'bukti_pembayaran' => $fileName,
                'status_pembayaran' => 1
            ];

            // Debug data
            log_message('info', 'Data pembayaran yang akan disimpan: ' . json_encode($data));

            // Cek pembayaran yang sudah ada
            $pembayaran = $this->M_Santri->getPembayaran($id_santri);

            if ($pembayaran) {
                // Update pembayaran yang sudah ada
                if (!$this->M_Santri->updatePembayaran($id_santri, $data)) {
                    throw new \Exception('Gagal mengupdate pembayaran');
                }
            } else {
                // Insert pembayaran baru
                if (!$this->M_Santri->insertPembayaran($data)) {
                    throw new \Exception('Gagal menyimpan pembayaran');
                }
            }

            session()->setFlashdata('success', 'Bukti pembayaran berhasil diupload');
            return redirect()->to('Santri/Pembayaran');
        } catch (\Exception $e) {
            log_message('error', 'Error upload pembayaran: ' . $e->getMessage());
            session()->setFlashdata('error', 'Gagal mengupload pembayaran: ' . $e->getMessage());
            return redirect()->to('Santri/Pembayaran');
        }
    }

    public function Berkas()
    {
        $id_santri = session()->get('id_santri');
        $data = [
            'title' => 'Upload Berkas',
            'berkas' => $this->M_Santri->getBerkas($id_santri)
        ];
        return view('santri/v_berkas', $data);
    }

    public function uploadBerkas()
    {
        $id_santri = session()->get('id_santri');
        
        if (empty($id_santri)) {
            session()->setFlashdata('error', 'Sesi tidak valid, silahkan login ulang');
            return redirect()->to('Auth/Logout');
        }

        // Validasi jenis berkas
        $jenis = $this->request->getPost('jenis');
        $validJenis = ['kk', 'akta', 'ijazah', 'skhun', 'ktp_ayah', 'ktp_ibu'];
        
        if (!in_array($jenis, $validJenis)) {
            session()->setFlashdata('error', 'Jenis berkas tidak valid');
            return redirect()->to('Santri/berkas');
        }

        // Validasi file
        $berkas = $this->request->getFile('berkas');
        if (!$berkas->isValid()) {
            session()->setFlashdata('error', 'File tidak valid');
            return redirect()->to('Santri/berkas');
        }

        // Validasi ekstensi dan ukuran
        $validMimes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($berkas->getMimeType(), $validMimes)) {
            session()->setFlashdata('error', 'Format file harus JPG/JPEG/PNG/PDF');
            return redirect()->to('Santri/berkas');
        }

        if ($berkas->getSizeByUnit('mb') > 2) {
            session()->setFlashdata('error', 'Ukuran file maksimal 2MB');
            return redirect()->to('Santri/berkas');
        }

        try {
            // Generate nama file baru
            $fileName = $berkas->getRandomName();
            
            // Pindahkan file
            if (!$berkas->move(FCPATH . 'berkas', $fileName)) {
                throw new \Exception('Gagal mengupload file');
            }

            // Update database
            $field = 'berkas_' . $jenis; // Tambahkan kembali prefix 'berkas_'
            $existingBerkas = $this->db->table('tbl_berkas_santri')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();
            
            // Hapus file lama jika ada
            if ($existingBerkas && !empty($existingBerkas[$field])) {
                $oldFile = FCPATH . 'berkas/' . $existingBerkas[$field];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $data = [
                'id_santri' => $id_santri,
                $field => $fileName,
                'status_berkas' => 'Menunggu Verifikasi'
            ];

            if ($existingBerkas) {
                // Update existing record
                $this->db->table('tbl_berkas_santri')
                    ->where('id_santri', $id_santri)
                    ->update([
                        $field => $fileName,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                // Insert new record
                $this->db->table('tbl_berkas_santri')->insert([
                    'id_santri' => $id_santri,
                    $field => $fileName,
                    'status_berkas' => 'Menunggu Verifikasi',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            // Update status berkas di tbl_santri
            $this->db->table('tbl_santri')
                ->where('id_santri', $id_santri)
                ->update(['status_berkas' => 1]);

            session()->setFlashdata('success', 'Berkas berhasil diupload');
            return redirect()->to('Santri/berkas');

        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal mengupload berkas: ' . $e->getMessage());
            return redirect()->to('Santri/berkas');
        }
    }

    public function DetailSantri()
    {
        $id_santri = session()->get('id_santri');

        // Log untuk debugging
        log_message('debug', 'Session Data: ' . json_encode(session()->get()));

        // Ambil data santri dari tbl_santri
        $santri = $this->M_Santri->getSantriDetail($id_santri);
        
        // Ambil data detail dari tbl_detail_santri
        $detail = $this->M_DetailSantri->where('id_santri', $id_santri)->first();

        // Jika detail belum ada, siapkan array kosong untuk menghindari error
        if (empty($detail)) {
            $detail = [];
        }

        // Log data yang diambil
        log_message('debug', 'Santri Data: ' . json_encode($santri));
        log_message('debug', 'Detail Data: ' . json_encode($detail));

        $data = [
            'title' => 'Detail Santri',
            'subtitle' => 'Detail Santri',
            'santri' => $santri,
            'detail' => $detail,
            'berkas' => $this->M_Santri->getBerkas($id_santri)
        ];

        return view('santri/v_detail_santri', $data);
    }

    public function CetakKartu()
    {
        $id_santri = session()->get('id_santri');
        $id_user = session()->get('id_user');

        // Ambil data santri dan user
        $data = [
            'title' => 'Cetak Kartu Pendaftaran',
            'santri' => $this->M_Santri->getSantriDetail($id_santri),
            'user' => $this->M_Santri->getUserData($id_user), // Tambahkan ini untuk mengambil data user termasuk foto
            'pembayaran' => $this->M_Santri->getPembayaran($id_santri)
        ];

        // Cek status pembayaran
        if (!$data['pembayaran'] || $data['pembayaran']['status_pembayaran'] != 2) {
            session()->setFlashdata('error', 'Anda harus menyelesaikan pembayaran terlebih dahulu');
            return redirect()->to('Santri');
        }

        return view('santri/v_cetak_kartu', $data);
    }

    public function GantiPassword()
    {
        $data = [
            'title' => 'Ganti Password',
            'subtitle' => 'Ganti Password'
        ];
        return view('santri/v_ganti_password', $data);
    }

    public function updatePassword()
    {
        $rules = [
            'password_lama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password lama harus diisi!'
                ]
            ],
            'password_baru' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi!',
                    'min_length' => 'Password minimal 6 karakter!'
                ]
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password_baru]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi!',
                    'matches' => 'Konfirmasi password tidak cocok!'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil data user dari session
        $id_user = session()->get('id_user');
        $user = $this->M_Santri->getUserData($id_user);
        $password_lama = md5($this->request->getPost('password_lama'));

        if ($password_lama !== $user['password']) {
            session()->setFlashdata('error', 'Password lama salah!');
            return redirect()->back();
        }

        // Update password
        $this->M_Santri->updatePassword($id_user, [
            'password' => md5($this->request->getPost('password_baru'))
        ]);

        session()->setFlashdata('pesan', 'Password berhasil diubah!');
        return redirect()->to('Santri/GantiPassword');
    }

    public function UpdateBiodata()
    {
        $id_santri = session()->get('id_santri');
        
        if (!$id_santri) {
            session()->setFlashdata('error', 'Sesi tidak valid');
            return redirect()->to('Auth/Logout');
        }

        // Data santri
        $dataSantri = [
            'nisn' => $this->request->getPost('nisn'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_hp' => $this->request->getPost('no_hp'),
            'asal_sekolah' => $this->request->getPost('asal_sekolah'),
        ];

        // Data orang tua dan detail
        $dataDetail = [
            'id_santri' => $id_santri,
            'nama_ayah' => $this->request->getPost('nama_ayah'),
            'nik_ayah' => $this->request->getPost('nik_ayah'),
            'pendidikan_ayah' => $this->request->getPost('pendidikan_ayah'),
            'pekerjaan_ayah' => $this->request->getPost('pekerjaan_ayah'),
            'penghasilan_ayah' => $this->request->getPost('penghasilan_ayah'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'nik_ibu' => $this->request->getPost('nik_ibu'),
            'pendidikan_ibu' => $this->request->getPost('pendidikan_ibu'),
            'pekerjaan_ibu' => $this->request->getPost('pekerjaan_ibu'),
            'penghasilan_ibu' => $this->request->getPost('penghasilan_ibu'),
            'no_hp_ortu' => $this->request->getPost('no_hp_ayah') . '/' . $this->request->getPost('no_hp_ibu'),
        ];

        // Jika checkbox wali tidak dicentang, tambahkan data wali
        if (!$this->request->getPost('sama_dengan_ortu')) {
            $dataDetail['nama_wali'] = $this->request->getPost('nama_wali');
            $dataDetail['nik_wali'] = $this->request->getPost('nik_wali');
            $dataDetail['pendidikan_wali'] = $this->request->getPost('pendidikan_wali');
            $dataDetail['pekerjaan_wali'] = $this->request->getPost('pekerjaan_wali');
            $dataDetail['penghasilan_wali'] = $this->request->getPost('penghasilan_wali');
            $dataDetail['no_hp_wali'] = $this->request->getPost('no_hp_wali');
        }

        try {
            $this->db->transStart();
            
            // Update tabel santri
            $this->M_Santri->update($id_santri, $dataSantri);
            
            // Cek apakah detail sudah ada
            $existingDetail = $this->M_DetailSantri->where('id_santri', $id_santri)->first();
            
            if ($existingDetail) {
                $this->M_DetailSantri->update($existingDetail['id_detail'], $dataDetail);
            } else {
                $this->M_DetailSantri->insert($dataDetail);
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data');
            }

            session()->setFlashdata('success', 'Data berhasil diperbarui');
            return redirect()->to('Santri/DetailSantri');

        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui data: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function updateBuktiPembayaran()
    {
        try {
            $id_pembayaran = $this->request->getPost('id_pembayaran');
            $bukti = $this->request->getFile('bukti_pembayaran');

            // Validasi file
            if (!$bukti->isValid()) {
                throw new \RuntimeException($bukti->getErrorString() . '(' . $bukti->getError() . ')');
            }

            if (!in_array($bukti->getClientMimeType(), ['image/jpg', 'image/jpeg', 'image/png'])) {
                throw new \RuntimeException('Format file harus JPG/JPEG/PNG');
            }

            if ($bukti->getSizeByUnit('mb') > 2) {
                throw new \RuntimeException('Ukuran file maksimal 2MB');
            }

            // Ambil data pembayaran lama
            $pembayaran = $this->db->table('tbl_pembayaran')
                ->where('id_pembayaran', $id_pembayaran)
                ->get()->getRowArray();

            // Hapus file lama jika ada
            if (!empty($pembayaran['bukti_pembayaran'])) {
                $path = FCPATH . 'bukti_pembayaran/' . $pembayaran['bukti_pembayaran'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Upload file baru
            $nama_file = $bukti->getRandomName();
            $bukti->move(FCPATH . 'bukti_pembayaran', $nama_file);

            // Update database
            $this->db->table('tbl_pembayaran')
                ->where('id_pembayaran', $id_pembayaran)
                ->update([
                    'bukti_pembayaran' => $nama_file,
                    'status_pembayaran' => 1, // Reset ke status menunggu verifikasi
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            session()->setFlashdata('success', 'Bukti pembayaran berhasil diupdate');
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }

        return redirect()->back();
    }
}

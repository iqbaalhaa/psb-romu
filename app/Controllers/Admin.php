<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pendaftar;
use CodeIgniter\Controller;
use App\Models\ModelAdmin;
use App\Models\ModelTahunAjaran;
use App\Models\ModelJurusan;

class Admin extends BaseController
{
    protected $M_Pendaftar;
    public $ModelAdmin;
    public $db;
    public $ModelTahunAjaran;
    public $ModelJurusan;

    public function __construct()
    {
        $this->session = session();
        $this->M_Pendaftar = new M_Pendaftar();
        $this->ModelAdmin = new ModelAdmin();
        $this->db = \Config\Database::connect();
        $this->ModelTahunAjaran = new ModelTahunAjaran();
        $this->ModelJurusan = new ModelJurusan();
    }

    public function index()
    {
        $db = \Config\Database::connect();

        // Data MTs
        $data['total_mts'] = $db->table('tbl_santri')
            ->where('jenjang', 'MTs')
            ->where('tahun_daftar', date('Y'))
            ->countAllResults();

        $data['pending_mts'] = $db->table('tbl_santri')
            ->where('jenjang', 'MTs')
            ->where('tahun_daftar', date('Y'))
            ->whereIn('status_pendaftaran', ['Berkas Diterima', 'Lulus Tes', 'Diterima'])
            ->countAllResults();

        $data['unpaid_mts'] = $db->table('tbl_santri s')
            ->join('tbl_pembayaran p', 'p.id_santri = s.id_santri', 'left')
            ->where('s.jenjang', 'MTs')
            ->where('s.tahun_daftar', date('Y'))
            ->where('p.id_pembayaran IS NULL')
            ->countAllResults();

        $data['verified_mts'] = $db->table('tbl_santri')
            ->where('jenjang', 'MTs')
            ->where('tahun_daftar', date('Y'))
            ->where('status_pendaftaran', 'Menunggu Verifikasi')
            ->countAllResults();

        // Data MA
        $data['total_ma'] = $db->table('tbl_santri')
            ->where('jenjang', 'MA')
            ->where('tahun_daftar', date('Y'))
            ->countAllResults();

        $data['pending_ma'] = $db->table('tbl_santri')
            ->where('jenjang', 'MA')
            ->where('tahun_daftar', date('Y'))
            ->whereIn('status_pendaftaran', ['Berkas Diterima', 'Lulus Tes', 'Diterima'])
            ->countAllResults();

        $data['unpaid_ma'] = $db->table('tbl_santri s')
            ->join('tbl_pembayaran p', 'p.id_santri = s.id_santri', 'left')
            ->where('s.jenjang', 'MA')
            ->where('s.tahun_daftar', date('Y'))
            ->where('p.id_pembayaran IS NULL')
            ->countAllResults();

        $data['verified_ma'] = $db->table('tbl_santri')
            ->where('jenjang', 'MA')
            ->where('tahun_daftar', date('Y'))
            ->where('status_pendaftaran', 'Menunggu Verifikasi')
            ->countAllResults();

        $data['title'] = 'Dashboard';
        $data['subtitle'] = 'Admin Panel';

        return view('admin/v_dashboard', $data);
    }

    public function PendaftarMTs()
    {
        $data = [
            'title' => 'Data Pendaftar MTs',
            'pendaftar' => $this->M_Pendaftar->getPendaftarMTs()
        ];
        return view('admin/v_pendaftar_mts', $data);
    }

    public function PendaftarMA()
    {
        $data = [
            'title' => 'Data Pendaftar MA',
            'pendaftar' => $this->M_Pendaftar->getPendaftarMA()
        ];
        return view('admin/v_pendaftar_ma', $data);
    }

    public function verifikasiPembayaran($id_pembayaran)
    {
        try {
            // Ambil id_santri dari pembayaran terlebih dahulu
            $pembayaran = $this->ModelAdmin->getPembayaranById($id_pembayaran);

            if (!$pembayaran) {
                throw new \Exception('Data pembayaran tidak ditemukan');
            }

            // Update status pembayaran
            $this->db->table('tbl_pembayaran')
                ->where('id_pembayaran', $id_pembayaran)
                ->update([
                    'status_pembayaran' => 2, // 2 = Lunas
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // Update status santri
            $this->db->table('tbl_santri')
                ->where('id_santri', $pembayaran['id_santri'])
                ->update([
                    'status_pembayaran' => 2, // 2 = Lunas
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            session()->setFlashdata('success', 'Pembayaran berhasil diverifikasi');

            // Redirect berdasarkan jenjang
            $jenjang = $this->ModelAdmin->getJenjangSantri($pembayaran['id_santri']);
            if ($jenjang == 'MA') {
                return redirect()->to(base_url('Admin/PembayaranMA'));
            } else {
                return redirect()->to(base_url('Admin/PembayaranMTs'));
            }
        } catch (\Exception $e) {
            log_message('error', 'Error verifikasi pembayaran: ' . $e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }

    private function updateStatusDashboardSantri($id_santri)
    {
        // Logika untuk memperbarui status di dashboard santri
        // Misalnya, update status di tabel santri
        $this->db->table('tbl_santri')
            ->where('id_santri', $id_santri)
            ->update(['status_pembayaran' => 1]); // 1 berarti sudah dibayar
    }

    public function tolakPembayaran($id_pembayaran)
    {
        try {
            $alasan = $this->request->getGet('alasan');

            if (empty($alasan)) {
                throw new \Exception('Alasan penolakan harus diisi');
            }

            // Ambil data pembayaran
            $pembayaran = $this->ModelAdmin->getPembayaranById($id_pembayaran);
            
            if (!$pembayaran) {
                throw new \Exception('Data pembayaran tidak ditemukan');
            }

            // Proses penolakan pembayaran
            if (!$this->ModelAdmin->tolakPembayaran($id_pembayaran, $alasan)) {
                throw new \Exception('Gagal menolak pembayaran');
            }

            session()->setFlashdata('success', 'Pembayaran berhasil ditolak');

            // Redirect berdasarkan jenjang
            $jenjang = $this->ModelAdmin->getJenjangSantri($pembayaran['id_santri']);
            if ($jenjang == 'MA') {
                return redirect()->to(base_url('Admin/PembayaranMA'));
            } else {
                return redirect()->to(base_url('Admin/PembayaranMTs'));
            }

        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function PembayaranMTs()
    {
        $data = [
            'title' => 'Data Pembayaran MTs',
            'pembayaran' => $this->M_Pendaftar->getPembayaranMTs()
        ];
        return view('admin/v_pembayaran_mts', $data);
    }

    public function PembayaranMA()
    {
        $data = [
            'title' => 'Data Pembayaran MA',
            'pembayaran' => $this->M_Pendaftar->getPembayaranMA()
        ];
        return view('admin/v_pembayaran_ma', $data);
    }

    public function BerkasMTs()
    {
        $data = [
            'title' => 'Verifikasi Berkas MTs',
            'berkas' => $this->M_Pendaftar->getBerkasMTs()
        ];
        return view('admin/v_berkas_mts', $data);
    }

    public function BerkasMA()
    {
        $data = [
            'title' => 'Verifikasi Berkas MA',
            'berkas' => $this->M_Pendaftar->getBerkasMA()
        ];
        return view('admin/v_berkas_ma', $data);
    }

    public function verifikasiBerkas($id_santri)
    {
        try {
            $db = \Config\Database::connect();
            
            // Update status di tbl_berkas_santri
            $db->table('tbl_berkas_santri')
                ->where('id_santri', $id_santri)
                ->update(['status_berkas' => 'Terverifikasi']);

            // Update status di tbl_santri
            $db->table('tbl_santri')
                ->where('id_santri', $id_santri)
                ->update(['status_berkas' => 1]);

            session()->setFlashdata('success', 'Berkas berhasil diverifikasi');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memverifikasi berkas: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function TahunAjaran()
    {
        $data = [
            'title' => 'Tahun Ajaran',
            'tahun_ajaran' => $this->ModelTahunAjaran->findAll()
        ];
        return view('admin/v_tahun_ajaran', $data);
    }

    public function TambahTahunAjaran()
    {
        $data = [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'is_active' => $this->request->getPost('is_active')
        ];

        // Jika status aktif, nonaktifkan semua tahun ajaran lain
        if ($data['is_active'] == '1') {
            $this->ModelTahunAjaran->where('id_tahun !=', 0)->set(['is_active' => '0'])->update();
        }

        $this->ModelTahunAjaran->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('Admin/TahunAjaran');
    }

    public function EditTahunAjaran($id)
    {
        $data = [
            'tahun_ajaran' => $this->request->getPost('tahun_ajaran'),
            'is_active' => $this->request->getPost('is_active')
        ];

        // Jika status aktif, nonaktifkan semua tahun ajaran lain
        if ($data['is_active'] == '1') {
            $this->ModelTahunAjaran->where('id_tahun !=', $id)->set(['is_active' => '0'])->update();
        }

        $this->ModelTahunAjaran->update($id, $data);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('Admin/TahunAjaran');
    }

    public function HapusTahunAjaran($id)
    {
        $this->ModelTahunAjaran->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('Admin/TahunAjaran');
    }

    public function Jurusan()
    {
        $data = [
            'title' => 'Data Jurusan',
            'jurusan' => $this->ModelJurusan->findAll()
        ];
        return view('admin/v_jurusan', $data);
    }

    public function TambahJurusan()
    {
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'kuota' => $this->request->getPost('kuota'),
            'is_active' => $this->request->getPost('is_active')
        ];

        $this->ModelJurusan->insert($data);
        session()->setFlashdata('pesan', 'Data jurusan berhasil ditambahkan');
        return redirect()->to('Admin/Jurusan');
    }

    public function EditJurusan($id)
    {
        $data = [
            'nama_jurusan' => $this->request->getPost('nama_jurusan'),
            'kuota' => $this->request->getPost('kuota'),
            'is_active' => $this->request->getPost('is_active')
        ];

        $this->ModelJurusan->update($id, $data);
        session()->setFlashdata('pesan', 'Data jurusan berhasil diupdate');
        return redirect()->to('Admin/Jurusan');
    }

    public function HapusJurusan($id)
    {
        $this->ModelJurusan->delete($id);
        session()->setFlashdata('pesan', 'Data jurusan berhasil dihapus');
        return redirect()->to('Admin/Jurusan');
    }

    public function User()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->ModelAdmin->getAllUsers()
        ];
        return view('admin/v_user', $data);
    }

    public function TambahUser()
    {
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'level' => $this->request->getPost('level'),
            'is_active' => $this->request->getPost('is_active'),
            'foto' => 'default.jpg'
        ];

        $this->ModelAdmin->insertUser($data);
        session()->setFlashdata('pesan', 'User berhasil ditambahkan');
        return redirect()->to('Admin/User');
    }

    public function EditUser($id)
    {
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
            'is_active' => $this->request->getPost('is_active')
        ];

        // Update password jika diisi
        if ($this->request->getPost('password') != '') {
            $data['password'] = md5($this->request->getPost('password'));
        }

        $this->ModelAdmin->updateUser($id, $data);
        session()->setFlashdata('pesan', 'User berhasil diupdate');
        return redirect()->to('Admin/User');
    }

    public function HapusUser($id)
    {
        $this->ModelAdmin->deleteUser($id);
        session()->setFlashdata('pesan', 'User berhasil dihapus');
        return redirect()->to('Admin/User');
    }

    public function DetailPendaftar($id_santri)
    {
        // Validasi ID
        if (empty($id_santri)) {
            session()->setFlashdata('error', 'ID Santri tidak valid');
            return redirect()->back();
        }

        try {
            // Ambil data santri dan user
            $santri = $this->M_Pendaftar->getDetailSantri($id_santri);
            if (!$santri) {
                throw new \Exception('Data santri tidak ditemukan');
            }

            // Sesuaikan status berkas menjadi boolean (0 atau 1)
            $santri['status_berkas'] = ($santri['status_berkas'] > 0) ? 1 : 0;

            // Ambil data detail santri (alamat dan orang tua)
            $detail = $this->db->table('tbl_detail_santri')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();

            // Ambil data pembayaran
            $pembayaran = $this->db->table('tbl_pembayaran')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();

            // Ambil data berkas
            $berkas = $this->db->table('tbl_berkas_santri')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();

            $data = [
                'title' => 'Detail Pendaftar',
                'santri' => $santri,
                'detail' => $detail,
                'pembayaran' => $pembayaran,
                'berkas' => $berkas
            ];

            return view('admin/v_detail_pendaftar', $data);

        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function CetakDetail($id_santri)
    {
        try {
            // Ambil data santri dan user
            $santri = $this->M_Pendaftar->getDetailSantri($id_santri);
            if (!$santri) {
                throw new \Exception('Data santri tidak ditemukan');
            }

            // Ambil data detail santri (alamat dan orang tua)
            $detail = $this->db->table('tbl_detail_santri')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();

            // Ambil data pembayaran
            $pembayaran = $this->db->table('tbl_pembayaran')
                ->where('id_santri', $id_santri)
                ->get()
                ->getRowArray();

            $data = [
                'title' => 'Cetak Detail Pendaftar',
                'santri' => $santri,
                'detail' => $detail,
                'pembayaran' => $pembayaran
            ];

            // Load view cetak yang khusus untuk print
            return view('admin/v_cetak_detail_pendaftar', $data);

        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function EditPendaftar($id)
    {
        try {
            // Ambil data santri
            $data['santri'] = $this->M_Pendaftar->getDetailSantri($id);
            if (!$data['santri']) {
                throw new \Exception('Data santri tidak ditemukan');
            }

            // Ambil data detail santri
            $data['detail'] = $this->db->table('tbl_detail_santri')
                ->where('id_santri', $id)
                ->get()
                ->getRowArray();

            $data['title'] = 'Edit Data Pendaftar';
            return view('admin/v_edit_pendaftar', $data);

        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to('Admin/PendaftarMTs');
        }
    }

    public function UpdatePendaftar($id)
    {
        try {
            // Validasi input
            $rules = [
                'nisn' => 'required',
                'nama_lengkap' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required|in_list[L,P]',
                'no_hp' => 'required',
                'gelombang' => 'required|in_list[1,2]',
                'alamat' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'provinsi' => 'required',
                'nama_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'nama_ibu' => 'required',
                'pekerjaan_ibu' => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
            }

            // Update data santri
            $dataSantri = [
                'nisn' => $this->request->getPost('nisn'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'no_hp' => $this->request->getPost('no_hp'),
                'gelombang' => $this->request->getPost('gelombang'),
            ];

            $this->db->transStart();
            
            $this->db->table('tbl_santri')
                ->where('id_santri', $id)
                ->update($dataSantri);

            // Update data detail santri
            $dataDetail = [
                'alamat' => $this->request->getPost('alamat'),
                'desa' => $this->request->getPost('desa'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kabupaten' => $this->request->getPost('kabupaten'),
                'provinsi' => $this->request->getPost('provinsi'),
                'nama_ayah' => $this->request->getPost('nama_ayah'),
                'pekerjaan_ayah' => $this->request->getPost('pekerjaan_ayah'),
                'nama_ibu' => $this->request->getPost('nama_ibu'),
                'pekerjaan_ibu' => $this->request->getPost('pekerjaan_ibu'),
            ];

            $this->db->table('tbl_detail_santri')
                ->where('id_santri', $id)
                ->update($dataDetail);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Gagal memperbarui data pendaftar');
            }

            session()->setFlashdata('success', 'Data pendaftar berhasil diperbarui');
            return redirect()->to('Admin/PendaftarMTs');

        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal memperbarui data: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function HapusPendaftar($id)
    {
        try {
            // Cek apakah data ada
            $santri = $this->M_Pendaftar->getDetailSantri($id);
            
            if (!$santri) {
                throw new \Exception('Data pendaftar tidak ditemukan.');
            }

            // Hapus data dari tabel terkait
            $this->db->transStart();
            
            // Hapus detail santri
            $this->db->table('tbl_detail_santri')->where('id_santri', $id)->delete();
            
            // Hapus pembayaran
            $this->db->table('tbl_pembayaran')->where('id_santri', $id)->delete();
            
            // Hapus berkas
            $this->db->table('tbl_berkas_santri')->where('id_santri', $id)->delete();
            
            // Hapus santri
            $this->db->table('tbl_santri')->where('id_santri', $id)->delete();
            
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Gagal menghapus data pendaftar.');
            }

            session()->setFlashdata('success', 'Data pendaftar berhasil dihapus.');
            return redirect()->to('Admin/PendaftarMTs');

        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->to('Admin/PendaftarMTs');
        }
    }
}

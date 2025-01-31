<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pendaftar;
use CodeIgniter\Controller;
use App\Models\ModelAdmin;

class Admin extends BaseController
{
    protected $M_Pendaftar;
    public $ModelAdmin;
    public $db;

    public function __construct()
    {
        $this->session = session();
        $this->M_Pendaftar = new M_Pendaftar();
        $this->ModelAdmin = new ModelAdmin();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'statistik_mts' => $this->M_Pendaftar->getStatistikMTs(),
            'statistik_ma' => $this->M_Pendaftar->getStatistikMA()
        ];
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

            $this->db->transStart();

            // Ambil data pembayaran
            $pembayaran = $this->ModelAdmin->getPembayaranById($id_pembayaran);

            if (!$pembayaran) {
                throw new \Exception('Data pembayaran tidak ditemukan');
            }

            // Update status pembayaran
            if (!$this->ModelAdmin->tolakPembayaran($id_pembayaran, $alasan)) {
                throw new \Exception('Gagal menolak pembayaran');
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Gagal menolak pembayaran');
            }

            session()->setFlashdata('pesan', 'Pembayaran berhasil ditolak');
        } catch (\Exception $e) {
            log_message('error', 'Error tolak pembayaran: ' . $e->getMessage());
            session()->setFlashdata('error', $e->getMessage());
        }

        // Redirect berdasarkan jenjang santri
        $jenjang = $this->ModelAdmin->getJenjangSantri($pembayaran['id_santri']);

        if ($jenjang == 'MA') {
            return redirect()->to('Admin/PembayaranMA');
        } else {
            return redirect()->to('Admin/PembayaranMTs');
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

    public function verifikasiBerkas($id)
    {
        $this->db->table('tbl_santri')
            ->where('id_santri', $id)
            ->update(['status_berkas' => 1]);

        session()->setFlashdata('success', 'Berkas berhasil diverifikasi');
        return redirect()->back();
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pendaftar;

class Admin extends BaseController
{
    protected $M_Pendaftar;

    public function __construct()
    {
        $this->session = session();
        $this->M_Pendaftar = new M_Pendaftar();
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

    public function verifikasiPembayaran($id)
    {
        $this->db->table('tbl_pembayaran')
            ->where('id_pembayaran', $id)
            ->update(['status_pembayaran' => 2]);

        session()->setFlashdata('success', 'Pembayaran berhasil diverifikasi');
        return redirect()->back();
    }

    public function tolakPembayaran($id)
    {
        $alasan = $this->request->getGet('alasan');
        $this->db->table('tbl_pembayaran')
            ->where('id_pembayaran', $id)
            ->update([
                'status_pembayaran' => 0,
                'keterangan' => $alasan
            ]);

        session()->setFlashdata('success', 'Pembayaran ditolak');
        return redirect()->back();
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

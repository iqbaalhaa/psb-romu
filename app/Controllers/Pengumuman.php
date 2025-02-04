<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Pengumuman;

class Pengumuman extends BaseController
{
    protected $PengumumanModel;

    public function __construct()
    {
        $this->PengumumanModel = new M_Pengumuman();
    }

    // Method untuk Admin
    public function index()
    {
        $data = [
            'title' => 'Data Pengumuman',
            'pengumuman' => $this->PengumumanModel->findAll()
        ];
        return view('admin/v_pengumuman', $data);
    }

    public function add()
    {
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'tanggal' => date('Y-m-d H:i:s')
        ];

        $this->PengumumanModel->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        return redirect()->to(base_url('Pengumuman'));
    }

    public function edit($id)
    {
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
        ];

        $this->PengumumanModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data berhasil diubah!');
        return redirect()->to(base_url('Pengumuman'));
    }

    public function delete($id)
    {
        $this->PengumumanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to(base_url('Pengumuman'));
    }

    // Method untuk Santri
    public function pengumumanSantri()
    {
        $data = [
            'title' => 'Pengumuman',
            'pengumuman' => $this->PengumumanModel->orderBy('tanggal', 'DESC')->findAll()
        ];
        return view('santri/v_pengumuman', $data);
    }
}

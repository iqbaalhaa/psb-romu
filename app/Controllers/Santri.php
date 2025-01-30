<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_Santri;
use App\Models\ModelSantri;

class Santri extends BaseController
{
    protected $M_Santri;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_Santri = new M_Santri();
        helper(['form', 'url']);
    }

    public function index()
    {
        $id_santri = session()->get('id_santri');

        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'Dashboard Santri',
            'santri' => $this->M_Santri->getSantriDetail($id_santri)
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

        // Debug session
        log_message('info', 'Session Data: ' . json_encode(session()->get()));

        if (empty($id_santri)) {
            log_message('error', 'ID Santri tidak ditemukan di session');
            session()->setFlashdata('error', 'Sesi tidak valid, silahkan login ulang');
            return redirect()->to('Auth/Logout');
        }

        $jenis = $this->request->getPost('jenis');

        if (empty($jenis)) {
            session()->setFlashdata('error', 'Jenis berkas tidak valid');
            return redirect()->to('Santri/Berkas');
        }

        $validationRule = [
            'berkas' => [
                'label' => 'Berkas',
                'rules' => 'uploaded[berkas]|mime_in[berkas,image/jpg,image/jpeg,image/png,application/pdf]|max_size[berkas,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->getError('berkas'));
            return redirect()->to('Santri/Berkas');
        }

        try {
            $file = $this->request->getFile('berkas');
            $fileName = $file->getRandomName();

            // Pastikan direktori ada
            $uploadPath = FCPATH . 'berkas';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if (!$file->move($uploadPath, $fileName)) {
                throw new \Exception('Gagal mengupload file');
            }

            // Siapkan data untuk database
            $data = [
                'id_santri' => $id_santri,
                $jenis => $fileName
            ];

            // Debug data
            log_message('info', 'Data berkas yang akan disimpan: ' . json_encode($data));

            // Cek berkas yang sudah ada
            $berkas = $this->M_Santri->getBerkas($id_santri);

            if ($berkas) {
                // Update berkas yang sudah ada
                if (!$this->M_Santri->updateBerkas($id_santri, [$jenis => $fileName])) {
                    throw new \Exception('Gagal mengupdate berkas');
                }
            } else {
                // Insert berkas baru
                if (!$this->M_Santri->insertBerkas($data)) {
                    throw new \Exception('Gagal menyimpan berkas');
                }
            }

            session()->setFlashdata('success', 'Berkas berhasil diupload');
            return redirect()->to('Santri/Berkas');
        } catch (\Exception $e) {
            log_message('error', 'Error upload berkas: ' . $e->getMessage());
            session()->setFlashdata('error', 'Gagal mengupload berkas: ' . $e->getMessage());
            return redirect()->to('Santri/Berkas');
        }
    }

    public function DetailSantri()
    {
        $id_santri = session()->get('id_santri');

        // Gunakan M_Santri yang sudah ada
        $data = [
            'title' => 'Detail Santri',
            'subtitle' => 'Detail Santri',
            'santri' => $this->M_Santri->getSantriByUserId($id_santri),
            'detail' => $this->M_Santri->DetailDataOrangTua($id_santri),
            'berkas' => $this->M_Santri->getBerkas($id_santri)
        ];

        // Debugging
        // var_dump($data['santri']);
        // die();

        return view('santri/v_detail_santri', $data);
    }
}

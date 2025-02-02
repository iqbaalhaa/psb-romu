<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Santri extends Model
{
    protected $table = 'tbl_santri';
    protected $primaryKey = 'id_santri';
    protected $allowedFields = ['id_user', 'no_pendaftaran', 'nisn', 'nama_lengkap', 'jenjang', 'gelombang', 'status_berkas'];

    public function insertSantri($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID(); // Mengembalikan id_santri yang baru dibuat
    }

    public function getPembayaran($id_santri)
    {
        return $this->db->table('tbl_pembayaran')
            ->where('id_santri', $id_santri)
            ->get()
            ->getRowArray();
    }

    public function getBerkas($id_santri)
    {
        return $this->db->table('tbl_berkas')
            ->where('id_santri', $id_santri)
            ->get()
            ->getRowArray();
    }

    public function insertPembayaran($data)
    {
        try {
            // Pastikan id_santri ada dan valid
            if (!isset($data['id_santri']) || empty($data['id_santri'])) {
                log_message('error', 'Insert Pembayaran - ID Santri kosong. Data: ' . json_encode($data));
                throw new \Exception('ID Santri tidak valid');
            }

            // Cek apakah sudah ada pembayaran untuk santri ini
            $existing = $this->getPembayaran($data['id_santri']);

            if ($existing) {
                // Jika sudah ada, lakukan update
                return $this->updatePembayaran($data['id_santri'], $data);
            }

            // Jika belum ada, lakukan insert
            $result = $this->db->table('tbl_pembayaran')->insert($data);

            if (!$result) {
                log_message('error', 'Gagal insert pembayaran: ' . json_encode($this->db->error()));
                throw new \Exception('Gagal menyimpan pembayaran');
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error insertPembayaran: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updatePembayaran($id_santri, $data)
    {
        try {
            if (empty($id_santri)) {
                log_message('error', 'Update Pembayaran - ID Santri kosong');
                throw new \Exception('ID Santri tidak valid');
            }

            $result = $this->db->table('tbl_pembayaran')
                ->where('id_santri', $id_santri)
                ->update($data);

            if ($this->db->affectedRows() === 0) {
                // Jika tidak ada baris yang terupdate, coba insert
                return $this->insertPembayaran($data);
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error updatePembayaran: ' . $e->getMessage());
            throw $e;
        }
    }

    public function insertBerkas($data)
    {
        try {
            // Pastikan id_santri ada dan valid
            if (!isset($data['id_santri']) || empty($data['id_santri'])) {
                log_message('error', 'Insert Berkas - ID Santri kosong. Data: ' . json_encode($data));
                throw new \Exception('ID Santri tidak valid');
            }

            // Cek apakah sudah ada data berkas untuk santri ini
            $existing = $this->getBerkas($data['id_santri']);

            if ($existing) {
                // Jika sudah ada, lakukan update
                return $this->updateBerkas($data['id_santri'], $data);
            }

            // Jika belum ada, lakukan insert
            $result = $this->db->table('tbl_berkas')->insert($data);

            if (!$result) {
                log_message('error', 'Gagal insert berkas: ' . json_encode($this->db->error()));
                throw new \Exception('Gagal menyimpan berkas');
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error insertBerkas: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateBerkas($id_santri, $data)
    {
        try {
            if (empty($id_santri)) {
                log_message('error', 'Update Berkas - ID Santri kosong');
                throw new \Exception('ID Santri tidak valid');
            }

            // Hapus id_santri dari data update jika ada
            unset($data['id_santri']);

            $result = $this->db->table('tbl_berkas')
                ->where('id_santri', $id_santri)
                ->update($data);

            if ($this->db->affectedRows() === 0) {
                // Jika tidak ada baris yang terupdate, coba insert
                $data['id_santri'] = $id_santri;
                return $this->insertBerkas($data);
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error updateBerkas: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSantriByUserId($id_user)
    {
        return $this->db->table('tbl_santri')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }

    public function DetailDataOrangTua($id_santri)
    {
        return $this->db->table('tbl_ortu')
            ->where('id_santri', $id_santri)
            ->get()
            ->getRowArray();
    }

    public function getSantriDetail($id_santri)
    {
        return $this->db->table('tbl_santri')
            ->where('id_santri', $id_santri)
            ->get()
            ->getRowArray();
    }

    public function hitungPersentaseBerkas($id_santri)
    {
        try {
            $berkas = $this->getBerkas($id_santri);
            if (!$berkas) {
                return 0;
            }

            $totalField = 5; // Jumlah total berkas yang harus diupload
            $fieldTerisi = 0;

            // Hitung berkas yang sudah diupload
            if (!empty($berkas['kartu_keluarga'])) $fieldTerisi++;
            if (!empty($berkas['akta_kelahiran'])) $fieldTerisi++;
            if (!empty($berkas['foto'])) $fieldTerisi++;
            if (!empty($berkas['ijazah'])) $fieldTerisi++;
            if (!empty($berkas['ktp_ortu'])) $fieldTerisi++;

            return ($fieldTerisi / $totalField) * 100;
        } catch (\Exception $e) {
            log_message('error', 'Error hitungPersentaseBerkas: ' . $e->getMessage());
            return 0;
        }
    }
}

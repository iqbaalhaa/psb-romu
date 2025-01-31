<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'password', 'level', 'foto'];

    public function getPembayaranMA()
    {
        return $this->db->table('tbl_pembayaran p')
            ->select('p.*, s.nama_lengkap, s.no_pendaftaran, s.gelombang')
            ->join('tbl_santri s', 's.id_santri = p.id_santri')
            ->where('s.jenjang', 'MA')
            ->get()
            ->getResultArray();
    }

    public function getPembayaranMTs()
    {
        return $this->db->table('tbl_pembayaran p')
            ->select('p.*, s.nama_lengkap, s.no_pendaftaran, s.gelombang')
            ->join('tbl_santri s', 's.id_santri = p.id_santri')
            ->where('s.jenjang', 'MTs')
            ->get()
            ->getResultArray();
    }

    public function verifikasiPembayaran($id_pembayaran)
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Dapatkan data pembayaran
            $pembayaran = $this->getPembayaranById($id_pembayaran);

            if (!$pembayaran) {
                throw new \Exception('Data pembayaran tidak ditemukan');
            }

            // Update status di tabel pembayaran
            $db->table('tbl_pembayaran')
                ->where('id_pembayaran', $id_pembayaran)
                ->update([
                    'status_pembayaran' => 2, // 2 = Lunas
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // Update status di tabel santri
            $db->table('tbl_santri')
                ->where('id_santri', $pembayaran['id_santri'])
                ->update([
                    'status_pembayaran' => 2, // 2 = Lunas
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal memverifikasi pembayaran');
            }

            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error verifikasi pembayaran: ' . $e->getMessage());
            return false;
        }
    }

    public function tolakPembayaran($id_pembayaran, $alasan)
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            // Update status pembayaran
            $this->db->table('tbl_pembayaran')
                ->where('id_pembayaran', $id_pembayaran)
                ->update([
                    'status_pembayaran' => 0,
                    'alasan_tolak' => $alasan,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // Dapatkan id_santri dari pembayaran
            $pembayaran = $this->getPembayaranById($id_pembayaran);

            if ($pembayaran) {
                // Update status pendaftaran santri
                $this->db->table('tbl_santri')
                    ->where('id_santri', $pembayaran['id_santri'])
                    ->update([
                        'status_pendaftaran' => 'Pembayaran Ditolak',
                        'alasan_penolakan' => $alasan,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }

            $db->transComplete();
            return $db->transStatus();
        } catch (\Exception $e) {
            $db->transRollback();
            throw $e;
        }
    }

    public function getPembayaranById($id_pembayaran)
    {
        return $this->db->table('tbl_pembayaran')
            ->where('id_pembayaran', $id_pembayaran)
            ->get()
            ->getRowArray();
    }

    public function getJenjangSantri($id_santri)
    {
        return $this->db->table('tbl_santri')
            ->where('id_santri', $id_santri)
            ->get()
            ->getRowArray()['jenjang'];
    }
}

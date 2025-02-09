<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pendaftaran extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'password', 'level', 'jenjang', 'foto'];

    public function simpanPendaftaran($data_user, $data_santri)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Simpan data user
        $this->insert($data_user);
        $id_user = $db->insertID();

        // Generate no pendaftaran (format: JENJANG-TAHUN-NOMOR)
        $tahun = date('Y');
        $query = $db->query(
            "SELECT MAX(SUBSTRING_INDEX(no_pendaftaran, '-', -1)) as max_number 
                            FROM tbl_santri 
                            WHERE jenjang = ? 
                            AND YEAR(created_at) = ?",
            [$data_santri['jenjang'], $tahun]
        );
        $result = $query->getRow();
        $nomor = (int)$result->max_number + 1;
        $data_santri['no_pendaftaran'] = $data_santri['jenjang'] . '-' . $tahun . '-' . sprintf('%04d', $nomor);

        // Tambahkan id_user ke data santri
        $data_santri['id_user'] = $id_user;
        $data_santri['tahun_daftar'] = $tahun;

        // Simpan data santri
        $db->table('tbl_santri')->insert($data_santri);

        $db->transComplete();
        return $db->transStatus();
    }

    public function insertUser($data)
    {
        // Pastikan koneksi database
        $db = \Config\Database::connect();
        
        // Insert ke tabel user
        $db->table('tbl_user')->insert($data);
        
        // Ambil id yang baru saja di-insert
        $id_user = $db->insertID();
        
        // Log untuk debugging
        log_message('info', 'User berhasil disimpan dengan ID: ' . $id_user);
        
        return $id_user;
    }

    public function insertSantri($data)
    {
        // Pastikan koneksi database
        $db = \Config\Database::connect();
        
        // Log data yang akan disimpan
        log_message('info', 'Data santri yang akan disimpan: ' . json_encode($data));
        
        // Insert ke tabel santri
        $result = $db->table('tbl_santri')->insert($data);
        
        // Log hasil insert
        log_message('info', 'Hasil insert santri: ' . ($result ? 'success' : 'failed'));
        
        return $result;
    }

    public function getLastId()
    {
        $db = \Config\Database::connect();
        $result = $db->table('tbl_santri')
                    ->select('id_santri')
                    ->orderBy('id_santri', 'DESC')
                    ->limit(1)
                    ->get()
                    ->getRow();
                    
        // Log untuk debugging
        log_message('info', 'Last ID: ' . ($result ? $result->id_santri : '0'));
        
        return $result ? $result->id_santri : 0;
    }
}

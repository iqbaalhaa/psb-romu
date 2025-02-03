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
}

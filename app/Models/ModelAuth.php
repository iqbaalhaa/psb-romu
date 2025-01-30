<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = ['nama_user', 'email', 'password', 'level', 'jenjang', 'foto', 'is_active', 'created_at'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';

    public function CekLogin($email, $password)
    {
        return $this->db->table('tbl_user')
            ->where([
                'email' => $email,
                'password' => $password
            ])
            ->get()
            ->getRowArray();
    }

    public function getSantriData($id_user)
    {
        $query = $this->db->table('tbl_santri')
            ->select('
                tbl_santri.*,
                COALESCE(p.status_pembayaran, 0) as status_pembayaran,
                IF(b.kk IS NOT NULL AND b.akta IS NOT NULL AND b.ijazah IS NOT NULL, 1, 0) as status_berkas
            ')
            ->where('tbl_santri.id_user', $id_user)
            ->join('tbl_pembayaran p', 'p.id_santri = tbl_santri.id_santri', 'left')
            ->join('tbl_berkas b', 'b.id_santri = tbl_santri.id_santri', 'left');

        // Debug: Log the generated SQL
        log_message('debug', 'Generated SQL: ' . $query->getCompiledSelect(false));

        return $query->get()->getRowArray();
    }
}

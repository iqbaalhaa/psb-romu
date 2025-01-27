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
        return $this->db->table('tbl_santri')
            ->where('id_user', $id_user)
            ->get()
            ->getRowArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $allowedFields    = [
        'nama_user', 
        'email', 
        'password', 
        'level', 
        'jenjang', 
        'foto', 
        'is_active', 
        'created_at',
        'reset_token',
        'reset_token_expires'
    ];
    protected $useTimestamps    = false;

    public function CekLogin($email, $password)
    {
        return $this->db->table('tbl_user')
            ->where([
                'email' => $email,
                'password' => md5($password)
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
                IF(b.berkas_kk IS NOT NULL AND b.berkas_akta IS NOT NULL AND b.berkas_ijazah IS NOT NULL, 1, 0) as status_berkas
            ')
            ->where('tbl_santri.id_user', $id_user)
            ->join('tbl_pembayaran p', 'p.id_santri = tbl_santri.id_santri', 'left')
            ->join('tbl_berkas_santri b', 'b.id_santri = tbl_santri.id_santri', 'left');

        // Debug: Log the generated SQL
        log_message('debug', 'Generated SQL: ' . $query->getCompiledSelect(false));

        return $query->get()->getRowArray();
    }

    public function getUserByEmail($email)
    {
        // Debug: tampilkan query yang dijalankan
        $user = $this->db->table('tbl_user')
            ->where('email', $email)
            ->get()
            ->getRowArray();
        
        // Debug: log hasil query
        log_message('debug', 'Query: ' . $this->db->getLastQuery());
        log_message('debug', 'Result: ' . print_r($user, true));
        
        return $user;
    }

    public function getUserByResetToken($token)
    {
        return $this->where('reset_token', $token)
                    ->where('reset_token_expires >', date('Y-m-d H:i:s'))
                    ->first();
    }

    public function updateResetToken($userId, $token)
    {
        return $this->update($userId, [
            'reset_token' => $token,
            'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);
    }

    public function resetPassword($userId, $newPassword)
    {
        return $this->update($userId, [
            'password' => md5($newPassword),
            'reset_token' => null,
            'reset_token_expires' => null
        ]);
    }
}

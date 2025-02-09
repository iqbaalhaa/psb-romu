<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $allowedFields = ['judul', 'isi', 'tanggal'];

    public function getPengumumanAktif()
    {
        return $this->orderBy('tanggal', 'DESC')
                    ->findAll();
    }

    public function getAllPengumuman()
    {
        return $this->orderBy('tanggal', 'DESC')
                    ->findAll();
    }
} 
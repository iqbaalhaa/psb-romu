<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    protected $allowedFields = ['judul', 'isi', 'tanggal'];
}

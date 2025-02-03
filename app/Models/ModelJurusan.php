<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJurusan extends Model
{
    protected $table = 'tbl_jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['nama_jurusan', 'kuota', 'is_active'];
}

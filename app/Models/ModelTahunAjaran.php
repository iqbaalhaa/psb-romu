<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTahunAjaran extends Model
{
    protected $table = 'tbl_tahun_ajaran';
    protected $primaryKey = 'id_tahun';
    protected $allowedFields = ['tahun_ajaran', 'is_active'];
}

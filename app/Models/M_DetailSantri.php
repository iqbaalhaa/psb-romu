<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DetailSantri extends Model
{
    protected $table = 'tbl_detail_santri';
    protected $primaryKey = 'id_detail';
    protected $allowedFields = [
        'id_santri',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'nama_ayah',
        'nik_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'nik_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'no_hp_ibu',
        'nama_wali',
        'nik_wali',
        'pendidikan_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'no_hp_wali'
    ];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getDetailSantri($id_santri)
    {
        return $this->where('id_santri', $id_santri)->first();
    }

    public function updateOrInsert($id_santri, $data)
    {
        $existing = $this->where('id_santri', $id_santri)->first();

        if ($existing) {
            // Update jika data sudah ada
            return $this->where('id_santri', $id_santri)->set($data)->update();
        } else {
            // Insert jika data belum ada
            $data['id_santri'] = $id_santri;
            return $this->insert($data);
        }
    }
} 
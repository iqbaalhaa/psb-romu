<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pendaftar extends Model
{
    protected $table = 'tbl_santri';
    protected $primaryKey = 'id_santri';

    public function getPendaftarMTs()
    {
        return $this->db->table('tbl_santri')
            ->select('
                tbl_santri.id_santri,
                tbl_santri.no_pendaftaran,
                tbl_santri.nisn,
                tbl_santri.nama_lengkap,
                tbl_santri.gelombang,
                tbl_santri.status_berkas,
                tbl_user.*,
                tbl_pembayaran.status_pembayaran,
                tbl_pembayaran.id_pembayaran
            ')
            ->join('tbl_user', 'tbl_user.id_user = tbl_santri.id_user')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri', 'left')
            ->where('tbl_santri.jenjang', 'MTs')
            ->get()->getResultArray();
    }

    public function getPendaftarMA()
    {
        return $this->db->table('tbl_santri')
            ->select('
                tbl_santri.id_santri,
                tbl_santri.no_pendaftaran,
                tbl_santri.nisn,
                tbl_santri.nama_lengkap,
                tbl_santri.gelombang,
                tbl_santri.status_berkas,
                tbl_user.*,
                tbl_pembayaran.status_pembayaran,
                tbl_pembayaran.id_pembayaran
            ')
            ->join('tbl_user', 'tbl_user.id_user = tbl_santri.id_user')
            ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri', 'left')
            ->where('tbl_santri.jenjang', 'MA')
            ->get()->getResultArray();
    }

    public function getDetailSantri($id_santri)
    {
        return $this->db->table('tbl_santri')
            ->select('tbl_santri.*, tbl_user.*')
            ->join('tbl_user', 'tbl_user.id_user = tbl_santri.id_user')
            ->where('tbl_santri.id_santri', $id_santri)
            ->get()->getRowArray();
    }

    public function getPembayaranMTs()
    {
        return $this->db->table('tbl_pembayaran')
            ->select('
                tbl_pembayaran.*,
                tbl_santri.nama_lengkap,
                tbl_santri.gelombang,
                tbl_santri.no_pendaftaran
            ')
            ->join('tbl_santri', 'tbl_santri.id_santri = tbl_pembayaran.id_santri')
            ->where('tbl_santri.jenjang', 'MTs')
            ->get()->getResultArray();
    }

    public function getPembayaranMA()
    {
        return $this->db->table('tbl_pembayaran')
            ->select('
                tbl_pembayaran.*,
                tbl_santri.nama_lengkap,
                tbl_santri.gelombang,
                tbl_santri.no_pendaftaran
            ')
            ->join('tbl_santri', 'tbl_santri.id_santri = tbl_pembayaran.id_santri')
            ->where('tbl_santri.jenjang', 'MA')
            ->get()->getResultArray();
    }

    public function getBerkasMTs()
    {
        return $this->db->table('tbl_santri')
            ->select('
                tbl_santri.*,
                tbl_berkas.kk,
                tbl_berkas.akta,
                tbl_berkas.ijazah
            ')
            ->join('tbl_berkas', 'tbl_berkas.id_santri = tbl_santri.id_santri', 'left')
            ->where('tbl_santri.jenjang', 'MTs')
            ->get()->getResultArray();
    }

    public function getBerkasMA()
    {
        return $this->db->table('tbl_santri')
            ->select('
                tbl_santri.*,
                tbl_berkas.kk,
                tbl_berkas.akta,
                tbl_berkas.ijazah
            ')
            ->join('tbl_berkas', 'tbl_berkas.id_santri = tbl_santri.id_santri', 'left')
            ->where('tbl_santri.jenjang', 'MA')
            ->get()->getResultArray();
    }

    public function getStatistikMTs()
    {
        return [
            'total' => $this->where('jenjang', 'MTs')->countAllResults(),
            'verified' => $this->where(['jenjang' => 'MTs', 'status_berkas' => 1])->countAllResults(),
            'unverified' => $this->where(['jenjang' => 'MTs', 'status_berkas' => 0])->countAllResults(),
            'paid' => $this->db->table('tbl_santri')
                ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri')
                ->where(['jenjang' => 'MTs', 'status_pembayaran' => 2])
                ->countAllResults(),
            'unpaid' => $this->db->table('tbl_santri')
                ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri')
                ->where(['jenjang' => 'MTs', 'status_pembayaran' => 0])
                ->countAllResults()
        ];
    }

    public function getStatistikMA()
    {
        return [
            'total' => $this->where('jenjang', 'MA')->countAllResults(),
            'verified' => $this->where(['jenjang' => 'MA', 'status_berkas' => 1])->countAllResults(),
            'unverified' => $this->where(['jenjang' => 'MA', 'status_berkas' => 0])->countAllResults(),
            'paid' => $this->db->table('tbl_santri')
                ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri')
                ->where(['jenjang' => 'MA', 'status_pembayaran' => 2])
                ->countAllResults(),
            'unpaid' => $this->db->table('tbl_santri')
                ->join('tbl_pembayaran', 'tbl_pembayaran.id_santri = tbl_santri.id_santri')
                ->where(['jenjang' => 'MA', 'status_pembayaran' => 0])
                ->countAllResults()
        ];
    }
}

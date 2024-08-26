<?php

namespace App\Models;

use CodeIgniter\Model;

class MBerkasInaktif extends Model
{
    protected $table = 'ev_berkas_inaktif'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_user',
        'id_es2',
        'id_sub_bidang',
        'id_klasifikasi',
        'no_berkas',
        'nama_berkas',
        'tahun_berkas',
        'lokasi_simpan',
        'media_simpan',
        'no_box',
    ];

    public function getDataByUserId($userId)
    {
        // Query untuk mengambil data berdasarkan user ID
        return $this->join('km_sub_bidang', 'ev_berkas_inaktif.id_sub_bidang=km_sub_bidang.id')
            ->where('id_user', $userId)->findAll();
    }
    public function getIdData($id)
    {
        return $this
            ->select('ev_berkas_inaktif.id as id, id_sub_bidang, id_klasifikasi, nama_sub_bidang, kode_klasifikasi, nama_klasifikasi, no_berkas, nama_berkas, tahun_berkas')
            ->join('km_klasifikasi', 'ev_berkas_inaktif.id_klasifikasi=km_klasifikasi.id', 'left')
            ->join('km_sub_bidang', 'ev_berkas_inaktif.id_sub_bidang=km_sub_bidang.id', 'left')
            ->where('ev_berkas_inaktif.id', $id)->get()->getRowArray();
    }
    public function semuaData()
    {
        return $this->get()->getResultArray();
    }
    public function jmlItem()
    {
        return $this->selectCount('ev_item_aktif.id as jml_item');
    }
    public function updateIdBerkas($id, $newIdBerkas)
    {
        return $this->db->table('ev_item_aktif')
            ->set('id_berkas', $newIdBerkas)
            ->where('id', $id)->update();
    }
}

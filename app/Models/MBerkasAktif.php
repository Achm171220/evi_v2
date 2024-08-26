<?php

namespace App\Models;

use CodeIgniter\Model;

class MBerkasAktif extends Model
{
    protected $table = 'ev_berkas_aktif'; // Ganti dengan nama tabel Anda
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
        return $this->join('km_sub_bidang', 'ev_berkas_aktif.id_sub_bidang=km_sub_bidang.id')
            ->where('id_user', $userId)->findAll();
    }
    public function getIdData($id)
    {
        return $this
            ->select('ev_berkas_aktif.id as id, id_sub_bidang, id_klasifikasi, nama_sub_bidang, kode_klasifikasi, nama_klasifikasi, no_berkas, nama_berkas, tahun_berkas')
            ->join('km_klasifikasi', 'ev_berkas_aktif.id_klasifikasi=km_klasifikasi.id', 'left')
            ->join('km_sub_bidang', 'ev_berkas_aktif.id_sub_bidang=km_sub_bidang.id', 'left')
            ->where('ev_berkas_aktif.id', $id)->get()->getRowArray();
    }
    public function getData($id)
    {
        return $this->select('ev_berkas_aktif.id as id, id_sub_bidang, id_klasifikasi, nama_sub_bidang, kode_klasifikasi, nama_klasifikasi, no_berkas, nama_berkas, tahun_berkas')
            ->join('km_klasifikasi', 'ev_berkas_aktif.id_klasifikasi=km_klasifikasi.id', 'left')
            ->join('km_sub_bidang', 'ev_berkas_aktif.id_sub_bidang=km_sub_bidang.id', 'left')
            ->where('ev_berkas_aktif.id', $id)->get()->getResultArray();
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
    public function getBerkasWithItemCount($id)
    {
        $builder = $this->db->table('ev_berkas_aktif');
        $builder->select('ev_berkas_aktif.id, no_berkas, nama_berkas, tahun_berkas, thn_item_awal, thn_item_akhir, status_berkas');
        $builder->select('(SELECT COUNT(*) FROM ev_item_aktif WHERE ev_item_aktif.id_berkas = ev_berkas_aktif.id) as jumlah_item');
        $builder->where('ev_berkas_aktif.id_user', $id);
        $builder->orderBy('ev_berkas_aktif.tahun_berkas', 'DESC');
        return $builder->get()->getResultArray();
    }
}

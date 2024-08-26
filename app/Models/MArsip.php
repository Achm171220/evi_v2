<?php

namespace App\Models;

use CodeIgniter\Model;

class MArsip extends Model
{
    /**
     * table name
     */
    protected $table = "ev_item_aktif";

    /**
     * allowed Field
     */
    protected $allowedFields = [
        'id',
        'id_user',
        'id_sub_bidang',
        'id_berkas',
        'id_klasifikasi',
        'no_dokumen',
        'judul_dokumen',
        'tgl_dokumen',
        'tahun_cipta',
        'jumlah',
        'tk_perkembangan',
        'lokasi_simpan',
        'media_simpan',
        'no_box',
        'status_arsip',
        'jenis_arsip',
        'dasar_catat',
    ];
    public function count()
    {
        return $this->db->table('ev_item_aktif')
            ->countAllResults();
    }
    public function countVital()
    {
        return $this->db->table('ev_item_aktif')->where('jenis_arsip', 'vital')
            ->countAllResults();
    }
    public function countId($id)
    {
        return $this->db->table('ev_item_aktif')
            ->where('id_user', $id)
            ->countAllResults();
    }
    public function allData()
    {
        return $this->db->table('ev_item_aktif')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id')
            ->get()->getResultArray();
    }
    public function getIdData($id)
    {
        return $this->db->table('ev_item_aktif')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id')
            ->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang=km_sub_bidang.id')
            ->where('ev_item_aktif.id', $id)
            ->get()->getRowArray();
    }
    public function getIdUser($id_user)
    {
        return $this->db->table('ev_item_aktif')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id')
            ->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang=km_sub_bidang.id')
            ->where('ev_item_aktif.id_user', $id_user)
            ->get()->getResultArray();
    }
    // untuk peminjmaman 
    public function getDataPinjam($id_user)
    {
        return $this->db->table('ev_item_aktif')
            ->select('ev_item_aktif.id as id, nama_sub_bidang, judul_dokumen, no_dokumen, tgl_dokumen, jenis_arsip')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id', 'left')
            ->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang=km_sub_bidang.id', 'left')
            ->where('ev_item_aktif.id_user', $id_user)
            ->get()->getResultArray();
    }
    public function rincianJmlArsip()
    {
        $sql = "SELECT km_es2.nama_es2 as nama_unit, COUNT(ev_item_aktif.id) as jml_arsip, km_es2.id as id_unit FROM ev_item_aktif INNER JOIN users ON ev_item_aktif.id_user=users.id INNER JOIN dd_hak_unit ON users.id=dd_hak_unit.id_user INNER JOIN km_es2 ON dd_hak_unit.parameter_unit=km_es2.id group by km_es2.id order by jml_arsip DESC;";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
    // vital arsip 
    public function getArsipData($subBidangId = null)
    {
        $builder = $this->builder();
        if ($subBidangId) {
            $builder->where('id_sub_bidang', $subBidangId);
            // $builder->where('id_sub_bidang', $subBidangId);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function arsipVital($id)
    {
        return $this->db->table('ev_item_aktif')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id','left')
            ->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang=km_sub_bidang.id','left')
            ->where('jenis_arsip', 'vital')
            ->where('ev_item_aktif.id_user', $id)
            ->get()->getResultArray();
    }
    public function getRekapitulasiArsip()
    {
        $builder = $this->db->table('km_es2');
        $builder->select('km_es2.id AS es2_id, km_es2.nama_es2 as nama_unit, COUNT(ev_item_aktif.id) AS jumlah_arsip')
            ->join('km_bidang', 'km_es2.id = km_bidang.id_es2')
            ->join('km_sub_bidang', 'km_bidang.id = km_sub_bidang.id_bidang')
            ->join('ev_item_aktif', 'km_sub_bidang.id = ev_item_aktif.id_sub_bidang', 'left')
            ->groupBy('km_es2.id, km_es2.nama_es2')
            ->orderBy('km_es2.id');

        $query = $builder->get();
        return $query->getResultArray();
    }
    public function daftarArsip($id)
    {
        return $this->db->table('ev_item_aktif')
            ->select('ev_item_aktif.id_user as id_user, kode_klasifikasi, no_berkas, nama_berkas, no_dokumen, judul_dokumen, tgl_dokumen, ev_item_aktif.media_simpan as media, derajat_keamanan, jenis_arsip, tk_perkembangan, jumlah, ev_item_aktif.lokasi_simpan, ev_item_aktif.no_box, dasar_catat')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi=km_klasifikasi.id', 'left')
            ->join('ev_berkas_aktif', 'ev_item_aktif.id_berkas=ev_berkas_aktif.id', 'left')
            ->where('ev_item_aktif.id_user', $id)
            ->orderBy('no_berkas', 'DESC')
            ->orderBy('tahun_cipta', 'DESC')
            ->get()->getResultArray();
    }
    public function getItems($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }
    public function updateIdBerkas($ids, $newIdBerkas)
    {
        $builder = $this->builder();
        $builder->whereIn('id', $ids);
        return $builder->update(['id_berkas' => $newIdBerkas]);
    }
    public function checkDuplicateNoDokumen(array $noDokumenList)
    {
        // Return an array of document numbers that already exist in the database
        return $this->whereIn('no_dokumen', $noDokumenList)->findColumn('no_dokumen') ?? [];
    }

    public function insertIfNotExist(array $data)
    {
        $noDokumenList = array_column($data, 'no_dokumen');
        $existingNoDokumen = $this->checkDuplicateNoDokumen($noDokumenList);

        $newData = array_filter($data, function ($row) use ($existingNoDokumen) {
            return !in_array($row['no_dokumen'], $existingNoDokumen);
        });

        if (!empty($newData)) {
            return $this->insertBatch($newData);
        }

        return 0; // No data inserted
    }

    public function getArsipInaktif($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('ev_item_aktif.*')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi = km_klasifikasi.id')
            ->where('id_user', $id)
            ->where('YEAR(CURDATE()) - ev_item_aktif.tahun_cipta > km_klasifikasi.umur_inaktif');

        $query = $builder->get();
        return $query->getResult();
    }
    public function getArsipExp($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('ev_item_aktif.*,umur_aktif, umur_inaktif')
            ->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi = km_klasifikasi.id')
            ->where('id_user', $id)
            ->where('YEAR(CURDATE()) - ev_item_aktif.tahun_cipta > km_klasifikasi.umur_inaktif');

        $query = $builder->get();
        return $query->getResult();
    }
}

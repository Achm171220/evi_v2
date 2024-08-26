<?php

namespace App\Models;

use CodeIgniter\Model;

class MAskiAkhir extends Model
{
    protected $table = 'view_sum_ai_auditee';
    protected $primaryKey = 'id';

    public function nilai_akhir($id)
    {
        $builder = $this->db->table($this->table);
        $builder->join('dd_hak_unit', 'view_sum_ai_auditee.id_es2=dd_hak_unit.parameter_unit', 'inner');
        $builder->join('users', 'dd_hak_unit.id_user=users.id', 'inner');
        $builder->where('users.id', $id);

        $query = $builder->get();
        return $query->getRowArray();
    }
    public function nilai_aski($id)
    {
        $query = "SELECT dd_hak_unit.parameter_unit, bobot_kategori, kategori, sub_kategori, nilai_standar_subkategori, total_nilai, skor_aski, skor FROM `view_skor_ai_subkategori` 
        LEFT JOIN dd_hak_unit ON view_skor_ai_subkategori.id_es2 = dd_hak_unit.parameter_unit 
        LEFT JOIN km_ai_kategori_up ON view_skor_ai_subkategori.id_kategori = km_ai_kategori_up.id
        WHERE id_user=$id;";
        $query = $this->db->query($query);
        return $query->getResultArray();
    }
}

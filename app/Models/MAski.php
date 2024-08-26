<?php

namespace App\Models;

use CodeIgniter\Model;

class MAski extends Model
{
    protected $table = 'view_skor_ai_subkategori';
    protected $primaryKey = 'id';

    public function nilai_penciptaan($id)
    {
        // $this->db->table('view_skor_ai_subkategori')
        //     // ->select('total_nilai, view_sum_ai_penciptaan_up.id_es2')
        //     ->join('dd_hak_unit', 'view_skor_ai_subkategori.id_es2=dd_hak_unit.parameter_unit', 'inner')
        //     ->join('users', 'dd_hak_unit.id_user=users.id', 'inner')
        //     ->where('users.id', $id)
        //     ->get()->getResultArray();

        return $this->select('view_skor_ai_subkategori.total_nilai as nilai, sub_kategori,id_subkategori, nilai_standar_subkategori as nilai_standar, skor_aski')
            ->join('dd_hak_unit', 'view_skor_ai_subkategori.id_es2=dd_hak_unit.parameter_unit', 'inner')
            ->join('users', 'dd_hak_unit.id_user=users.id', 'inner')
            ->where('users.id', $id)
            ->orderBy('view_skor_ai_subkategori.id_subkategori', 'ASC')
            ->findAll();
    }
    public function nilai_akhir($id)
    {
        return $this->selectCount('total_nilai as nilai_akhir')
            ->join('dd_hak_unit', 'view_skor_ai_subkategori.id_es2=dd_hak_unit.parameter_unit', 'inner')
            ->join('users', 'dd_hak_unit.id_user=users.id', 'inner')
            ->where('users.id', $id)
            ->orderBy('view_skor_ai_subkategori.id_subkategori', 'ASC')
            ->findAll();
    }
}

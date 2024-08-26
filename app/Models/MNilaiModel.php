<?php

namespace App\Models;

use CodeIgniter\Model;

class MNilaiModel extends Model
{
    protected $table = 'ev_nilai_aski';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user', 'id_es2', 'aspek', 'id_sub_aspek', 'nilai_standar', 'nilai', 'bobot_sub_aspek', 'nilai_sub_aspek', 'bobot_aspek', 'nilai_aspek'
    ];
    public function sub_aspek()
    {
        return $this->db->table('km_ai_subkategori_up')
            ->select('km_ai_subkategori_up.id as id, kategori, sub_kategori, bobot_subkategori, nilai_standar_subkategori')
            ->join('km_ai_kategori_up', 'km_ai_subkategori_up.id_kategori=km_ai_kategori_up.id')
            ->get()->getResultArray();
    }
}

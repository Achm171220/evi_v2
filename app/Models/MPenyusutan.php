<?php

namespace App\Models;

use CodeIgniter\Model;

class MPenyusutan extends Model
{
    protected $table = 'ev_pindah';
    protected $primaryKey = 'id';
    public function dataPindah($id)
    {
        return $this->db->table('ev_usul_pindah')
            ->join('km_sub_bidang', 'ev_usul_pindah.id_sub_bidang_usul=km_sub_bidang.id', 'left')
            ->where('id_user', $id)
            ->get()->getResultArray();
    }
}

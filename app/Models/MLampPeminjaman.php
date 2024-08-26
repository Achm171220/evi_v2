<?php

namespace App\Models;

use CodeIgniter\Model;

class MLampPeminjaman extends Model
{
    protected $table = 'ev_lam_pinjam_arsip';
    protected $allowedFields = ['no_pinjam', 'id_arsip'];
    
    public function getLampiranByNoPinjam($noPinjam)
    {
        $builder = $this->db->table($this->table);
        $builder->where('no_pinjam', $noPinjam);
        return $builder->get()->getResultArray();
    }
}

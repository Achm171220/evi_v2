<?php

namespace App\Models;

use CodeIgniter\Model;

class MKmsubbidang extends Model
{
    protected $table = 'km_sub_bidang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_bidang', 'nama_sub_bidang'];

    public function getIdUser($id)
    {
        return $this->join('km_bidang', 'km_sub_bidang.id_bidang=km_bidang.id', 'left')
            ->join('km_es2', 'km_bidang.id_es2=km_es2.id', 'left')
            ->join('dd_hak_unit', 'users.parameter_unit=km_es2.id', 'left')
            ->where('dd_hak_unit.id_users', $id)
            ->get()->getResultArray();
    }
}

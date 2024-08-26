<?php

namespace App\Models;

use CodeIgniter\Model;

class MRbac extends Model
{
    protected $table = 'dd_hak_unit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_user', 'nama_group', 'key_unit', 'level_unit', 'parameter_unit'];
    public function allData()
    {
        // Join dengan tabel posts
        return $this->select('')
            ->join('users', 'dd_hak_unit.id_user = users.id', 'left')
            ->join('km_es2', 'dd_hak_unit.parameter_unit = km_es2.id', 'left')
            ->orderBy('dd_hak_unit.id', 'DESC')
            ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MKmes2 extends Model
{
    protected $table = 'km_es2'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';

    public function getDataByUserId($userId)
    {
        // Query untuk mengambil data berdasarkan user ID
        return $this->join('dd_hak_unit', 'km_es2.id=dd_hak_unit.parameter_unit')
        ->where('id_user', $userId)->findAll();
    }
}

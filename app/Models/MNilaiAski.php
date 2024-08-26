<?php

namespace App\Models;

use CodeIgniter\Model;

class MNilaiAski extends Model
{
    protected $table = 'ev_nilai_aski_up';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user', 'id_es2', 'tahun', 'nilai_akhir', 'verifikasi'
    ];

    public function joinData()
    {
        return $this->select('ev_nilai_aski_up.id as id, nama_es2, nilai_akhir')
            ->join('km_es2', 'ev_nilai_aski_up.id_es2=km_es2.id', 'left')
            ->orderBy('km_es2.id')
            ->get()->getResultArray();
    }
}

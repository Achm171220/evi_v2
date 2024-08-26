<?php

namespace App\Models;

use CodeIgniter\Model;

class MKmbidang extends Model
{
    protected $table = 'km_bidang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_bidang', 'nama_bidang'];
}

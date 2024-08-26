<?php

namespace App\Models;

use CodeIgniter\Model;

class MSubAspek extends Model
{
    protected $table = 'km_ai_subkategori_up';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kategori', 'sub_kategori', 'bobot_subkategori', 'nilai_standar_subkategori'];
    
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MUserupdate extends Model
{
    protected $table = 'users_update_password';
    protected $allowedFields = ['id_user', 'old_passrowd', 'new_password', 'ip_address', 'perangkat', 'lokasi', 'update_at'];
}

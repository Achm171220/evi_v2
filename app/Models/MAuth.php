<?php

namespace App\Models;

use CodeIgniter\Model;

class MAuth extends Model
{
    public function login_user($email, $password)
    {
        return $this->db->table('users')->where([
            'email' => $email,
            'password' => $password
        ])->get()->getRowArray();
    }
    public function lastlogin($data)
    {
        $this->db->table('users')
            ->where('email', $data['email'])
            ->update($data);
    }
    public function login_sekre($email, $password)
    {
        return $this->db->table('tbl_sekre')->where([
            'email'          => $email,
            'password'       => $password
        ])->get()->getRowArray();
    }
    public function login_peg($email, $password)
    {
        return $this->db->table('tbl_pgw')->where([
            'email'      => $email,
            'nip'           => $password,
            'status'        => 1
        ])->get()->getRowArray();
    }
    public function login_guest($email, $password)
    {
        return $this->db->table('tbl_guest')->where([
            'email'      => $email,
            'password'      => $password,
            'status'        => 1
        ])->get()->getRowArray();
    }

    public function save_register($data)
    {
        $this->db->table('tbl_pgw')->insert($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MSubBidang extends Model
{
    public function allData()
    {
        return $this->db->table('km_sub_bidang')
            ->join('km_bidang', 'km_sub_bidang.id_bidang=km_bidang.id', 'left')
            ->join('km_es2', 'km_bidang.id_es2=km_es2.id', 'left')
            // ->orderBy('kode_bidang', 'ASC')
            ->get()->getResultArray();
    }
    public function idData($id)
    {
        return $this->db->table('km_sub_bidang')
            ->select('km_sub_bidang.id as id_sub, nama_sub_bidang, nama_es2')
            ->join('km_bidang', 'km_sub_bidang.id_bidang=km_bidang.id', 'left')
            ->join('km_es2', 'km_bidang.id_es2=km_es2.id', 'left')
            ->join('dd_hak_unit', 'km_es2.id=dd_hak_unit.parameter_unit', 'left')
            ->where('dd_hak_unit.id_user', $id)
            // ->orderBy('kode_bidang', 'ASC')
            ->get()->getResultArray();
    }
    public function add($data)
    {
        $this->db->table('tbl_bidang')->insert($data);
    }
    public function edit($data)
    {
        $this->db->table('tbl_bidang')
            ->where('id_bidang', $data['id_bidang'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_bidang')
            ->where('id_bidang', $data['id_bidang'])
            ->delete($data);
    }
    public function totbid()
    {
        return $this->db->table('tbl_bidang')->countAll();
    }
    public function getID($id_u)
    {
        $sql = "SELECT km_sub_bidang.id as id_sub, nama_sub_bidang, nama_es2, dd_hak_unit.id_user as id FROM `km_sub_bidang`
                LEFT JOIN km_bidang on km_sub_bidang.id_bidang=km_bidang.id
                LEFT JOIN km_es2 on km_bidang.id_es2=km_es2.id
                LEFT JOIN dd_hak_unit on km_es2.id=dd_hak_unit.parameter_unit
                WHERE dd_hak_unit.id_user=$id_u;";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}

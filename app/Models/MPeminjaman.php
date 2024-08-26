<?php

namespace App\Models;

use CodeIgniter\Model;

class MPeminjaman extends Model
{
    protected $table = 'ev_pinjam_arsip';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'no_pinjam', 'nama_peminjam', 'nip_peminjam', 'tgl_pinjam', 'tgl_kembali', 'range_pinjam', 'keterangan'];

    public function getPinjamArsipDetail($noPinjam)
    {
        $builder = $this->db->table($this->table);
        $builder->where('no_pinjam', $noPinjam);
        $pinjam = $builder->get()->getRowArray();

        if ($pinjam) {
            $lampiranModel = new MLampPeminjaman();
            $lampiran = $lampiranModel->getLampiranByNoPinjam($noPinjam);
            $pinjam['lampiran'] = $lampiran;
        }

        return $pinjam;
    }
}

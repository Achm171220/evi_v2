<?php

namespace App\Models;

use CodeIgniter\Model;

class MKlasifikasi extends Model
{
	protected $table                = 'km_klasifikasi';
	protected $primaryKey           = 'id';

	public function allData()
	{
		return $this->db->table('km_klasifikasi')
			// ->orderBy('nama_klasifikasi', 'ASC')
			// ->orderBy('kode_klasifikasi', 'DESC')
			->get()->getResultArray();
	}
}

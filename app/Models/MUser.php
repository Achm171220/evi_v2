<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
	/**
	 * table name
	 */
	protected $table = "users";
	protected $allowedFields = [
		'id',
		'name',
		'email',
		'password',
		'aktif',
		'created_at',
		'updated_at',
	];

	/**
	 * allowed Field
	 */
	public function allData()
	{
		return $this->findAll(); // Mengambil semua data pengguna
	}
	public function count()
	{
		return $this->db->table('users')
		->countAllResults();
	}
	public function dataUser($id_u)
	{
		return $this->db->table('dd_hak_unit')
			->join('km_es2', 'dd_hak_unit.parameter_unit = km_es2.id', 'left')
			->where('dd_hak_unit.id_user', $id_u)
			->get()->getRowArray();
	}
}

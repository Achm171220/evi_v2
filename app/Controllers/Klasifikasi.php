<?php

namespace App\Controllers;

use App\Models\MKlasifikasi;


class Klasifikasi extends BaseController
{
    protected $MKlasifikasi;
    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MKlasifikasi     = new MKlasifikasi();
    }
    public function index()
    {
        $data = [
            'judul'     => 'klasifikasi',
            'subjudul'  => 'data klasifikasi',
            'isi'       => 'klasifikasi/index',
            'dataKlas'  => $this->MKlasifikasi->findAll()
        ];
        return view('layout/wrapper', $data);
    }
}

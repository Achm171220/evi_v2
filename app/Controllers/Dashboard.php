<?php

namespace App\Controllers;

use App\Models\MArsip;
use App\Models\MArsipInaktif;
use App\Models\MAski;
use App\Models\MUser;
use App\Models\MAskiAkhir;
use App\Models\MKmes2;

class Dashboard extends BaseController
{
    protected $MArsip;
    protected $MArsipI;
    protected $MAski;
    protected $MUser;
    protected $MKmes2;
    protected $MAskiAkhir;

    public function __construct()
    {
        $session = session();
        $this->MArsipI    = new MArsipInaktif();
        $this->MArsip     = new MArsip();
        $this->MUser      = new MUser();
        $this->MAski      = new MAski();
        $this->MAskiAkhir  = new MAskiAkhir();
    }
    public function index()
    {
        $id = session()->get('id');
        $data = array(
            'judul'         => 'Dashboard',
            'subjudul'      => 'Home',
            'isi'           => 'dashboard/user',
            'data_user'     => $this->MUser->dataUser($id),
            'jml'           => $this->MArsip->countId($id),
            'jml_i'         => $this->MArsipI->countId($id),
            'n_penciptaan'  => $this->MAski->nilai_penciptaan($id),
            'nilai_final'   => $this->MAskiAkhir->nilai_akhir($id),
            'nilaiAski'     => $this->MAskiAkhir->nilai_aski($id),
            'jmlAktif'      => $this->MArsip->rincianJmlArsip($id),
        );
        return view('layout/wrapper', $data);
    }
    public function admin()
    {
        $MArsipI    = new MArsipInaktif();
        $MArsip     = new MArsip();
        $MUser      = new MUser();
        $MAski      = new MAski();
        $MAskiAkhir = new MAskiAkhir();
        $MKmes2     = new MKmes2();

        $units = $MKmes2->findAll();
        $rekapitulasi = [];
        $id = session()->get('id');


        foreach ($units as $unit) {
            $id = session()->get('id');
            $unitId = $unit['id'];
        };
        $data = [
            'judul'         => 'Dashboard',
            'subjudul'      => 'Home',
            'jml_arsip'     => $MArsip->count(),
            'jml_arsip_i'   => $MArsipI->count(),
            'jml_arsip_v'   => $MArsip->countVital(),
            'rekapitulasi'  => $MArsip->getRekapitulasiArsip(),
            'rekapitulasi_i'=> $MArsipI->getRekapitulasiArsipI(),
            'jml_user'      => $MUser->count(),
            'data_user'     => $MUser->dataUser($id),
            'isi'           => 'dashboard/admin',
            // 'rekapitulasi'  => $rekapitulasi,
        ];

        return view('layout/wrapper', $data);
    }
}

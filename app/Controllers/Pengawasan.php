<?php

namespace App\Controllers;

use App\Models\MUser;
use App\Models\MArsip;
use App\Models\MKmes2;
use App\Models\MPengawasan;
use App\Models\MNilaiModel;
use App\Models\MNilaiAski;
use App\Models\MSubAspek;


class Pengawasan extends BaseController
{
    protected $MUser;
    protected $MArsip;

    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MArsip           = new MArsip();
        $this->MUser            = new MUser();
    }
    public function index()
    {
        $MUser             = new MUser();
        $id_u = session()->get('id');
        $data = [
            'judul'         => 'Pengawasan',
            'subjudul'      => 'Pengawasan',
            'isi'           => 'pengawasan/index',
            'data_user'     => $MUser->dataUser($id_u),
        ];
        return view('layout/wrapper', $data);
    }
    public function admin()
    {
        $MUser              = new MUser();
        $id_u               = session()->get('id');
        $nilaiAskiModel     = new MNilaiAski();

        $data = [
            'judul'         => 'Pengawasan',
            'subjudul'      => 'Nilai Pengawasan',
            'isi'           => 'pengawasan/admin',
            'data_user'     => $MUser->dataUser($id_u),
            'data'          => $nilaiAskiModel->joinData(),
        ];
        return view('layout/wrapper', $data);
    }
    public function tambah()
    {
        $KMes2 = new MKmes2();
        $Aspek = new MNilaiModel();
        $data = [
            'units'     => $KMes2->findAll(),
            'aspeks'    => $Aspek->sub_aspek(),
        ];


        return view('pengawasan/add', $data);
    }
    public function store()
    {
        $nilaiModel = new MNilaiModel();
        $nilaiAskiModel = new MNilaiAski();

        $unitId = $this->request->getPost('id_es2');
        $aspeks = $this->request->getPost('aspek');
        $userId = session()->get('id');
        $totalNilaiAkhir = 0; // Variabel untuk menampung total nilai akhir

        foreach ($aspeks as $id_aspek => $nilai) {
            $aspekModel = new MSubAspek();
            $aspek = $aspekModel->find($id_aspek);
            $nilai_standar = $aspek['nilai_standar_subkategori'];
            $bobot = $aspek['bobot_subkategori'] / 100;

            if ($nilai_standar != 0) {
                $nilai_akhir = ($nilai / $nilai_standar) * $bobot * 100;
            } else {
                $nilai_akhir = 0; // Atau sesuaikan sesuai kebutuhan
            }

            $nilaiData = [
                'id_user'           => $userId,
                'id_es2'            => $unitId,
                'id_sub_aspek'      => $id_aspek,
                'nilai'             => $nilai,
                'nilai_sub_aspek'   => $nilai_akhir
            ];
            $nilaiModel->insert($nilaiData);
            // Ambil total nilai dari tabel_nilai berdasarkan id_unit yang baru saja diinput
            $totalNilaiAkhir = $nilaiModel
                ->where('id_es2', $unitId)
                ->selectSum('nilai_sub_aspek', 'total_akhir') // Menggunakan alias 'total_akhir'
                ->get()
                ->getRow()
                ->total_akhir; // Mengakses hasil dengan alias 'total_akhir'

        }
        $tahun = date('Y'); // Anda bisa ganti dengan tahun dinamis sesuai kebutuhan
        $askiData = [
            'id_es2'            => $unitId,
            'id_user'           => $userId,
            'tahun'             => $tahun,
            'nilai_akhir'       => $totalNilaiAkhir
        ];
        $nilaiAskiModel->insert($askiData);

        // print_r($nilaiModel);
        // Set session flashdata untuk pesan berhasil
        session()->setFlashdata('success', 'Data berhasil diinput!');
        return redirect()->to('pengawasan/tambah');
    }
}

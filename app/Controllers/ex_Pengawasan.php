<?php

namespace App\Controllers;

use App\Models\ai_MDataUmum;
use App\Models\ai_MPenciptaan;
use App\Models\MUser;

class Pengawasan extends BaseController
{
    public function index()

    {
        $id = session()->get('id');
        $ai_MDataUmum = new ai_MDataUmum();
        $data = [
            'judul'         => 'Pengawasan',
            'subjudul'      => 'Data Umum',
            'isi'       => 'pengawasan/dashboard',
            'IdDtUmum'  => $ai_MDataUmum->dtUmumId($id),
            'DtUmum'  => $ai_MDataUmum->dtUmumId2($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function dataUmum()

    {
        $id = session()->get('id');
        $ai_MDataUmum = new ai_MDataUmum();
        $MUser             = new MUser();
        $data = [
            'judul'         => 'Pengawasan',
            'subjudul'      => 'Data Umum',
            'isi'           => 'pengawasan/dataumum/index',
            'IdDtUmum'      => $ai_MDataUmum->dtUmumId($id),
            'DtUmum'        => $ai_MDataUmum->dtUmumId2($id),
            'data_user'     => $MUser->dataUser($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function store_dt_umum()
    {
        $MDataUmum = new ai_MDataUmum();

        $data = [
            'id_es2' => $this->request->getPost('id_es2'),
            'tahun_audit' => $this->request->getPost('tahun_audit'),
            'jml_srt_masuk' => $this->request->getPost('jml_srt_masuk'),
            'jml_srt_keluar' => $this->request->getPost('jml_srt_keluar'),
            'jml_arsiparis' => $this->request->getPost('jml_arsiparis'),
            'jml_pengelola_arsip' => $this->request->getPost('jml_pengelola_arsip'),
            'volume_arsip_aktif' => $this->request->getPost('volume_arsip_aktif'),
            'jml_arsip_aktif_terdaftar' => $this->request->getPost('jml_arsip_aktif_terdaftar'),
            'metode_penciptaan' => $this->request->getPost('metode_penciptaan'),
            'metode_penggunaan' => $this->request->getPost('metode_penggunaan'),
            'metode_pemeliharaan' => $this->request->getPost('metode_pemeliharaan'),
            'metode_penyusutan' => $this->request->getPost('metode_penyusutan'),
            'metode_sdm' => $this->request->getPost('metode_sdm'),
            'narahubung' => $this->request->getPost('narahubung'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
        ];

        $MDataUmum->add($data);
        return redirect()->to('/pengawasan/dataUmum');
    }
    public function update_dt_umum($id)
    {
        $MDataUmum = new ai_MDataUmum();

        $id = $this->request->getPost('id_es2');
        $data = [
            'id_es2' => $id,
            'tahun_audit' => $this->request->getPost('tahun_audit'),
            'jml_srt_masuk' => $this->request->getPost('jml_srt_masuk'),
            'jml_srt_keluar' => $this->request->getPost('jml_srt_keluar'),
            'jml_arsiparis' => $this->request->getPost('jml_arsiparis'),
            'jml_pengelola_arsip' => $this->request->getPost('jml_pengelola_arsip'),
            'volume_arsip_aktif' => $this->request->getPost('volume_arsip_aktif'),
            'jml_arsip_aktif_terdaftar' => $this->request->getPost('jml_arsip_aktif_terdaftar'),
            'metode_penciptaan' => $this->request->getPost('metode_penciptaan'),
            'metode_penggunaan' => $this->request->getPost('metode_penggunaan'),
            'metode_pemeliharaan' => $this->request->getPost('metode_pemeliharaan'),
            'metode_penyusutan' => $this->request->getPost('metode_penyusutan'),
            'metode_sdm' => $this->request->getPost('metode_sdm'),
            'narahubung' => $this->request->getPost('narahubung'),
            'nomor_hp' => $this->request->getPost('nomor_hp'),
        ];
        print_r($data);
        $MDataUmum->edit($data);

        return redirect()->to('/pengawasan/dataumum');
    }
    public function penciptaan()
    {
        $id = session()->get('id');
        $MUser             = new MUser();
        $MCipta            = new ai_MPenciptaan();
        $ai_MDataUmum      = new ai_MDataUmum();
        $data = [
            'judul'     => 'Pengawasan',
            'subjudul'  => 'Penciptaan',
            'isi'       => 'pengawasan/penciptaan/index2',
            'data_user' => $MUser->dataUser($id),
            'DtUmum'    => $ai_MDataUmum->dtUmumId2($id),
            'IdDtUmum'  => $ai_MDataUmum->dtUmumId($id),
            'form_e'    => $MCipta->getCiptaE(),
            'form_k'    => $MCipta->getCiptaK(),
            'getAi'         => $MCipta->getDataAi($id),
            'getMetode'     => $MCipta->getMetode($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function store_penciptaan()
    {
        $data = [
            'id_es2'        => $this->request->getPost('id_es2'),
            'id_es2'        => $this->request->getPost('id_es2'),
        ];
        
    }
}

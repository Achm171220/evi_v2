<?php

namespace App\Controllers;

use App\Models\MKlasifikasi;
use App\Models\MArsip;
use App\Models\MArsipInaktif;
use App\Models\MPenyusutan;
use App\Models\MKmes2;
use App\Models\MKmBidang;
use App\Models\MKmsubbidang;
use App\Models\MSubBidang;
use App\Models\MUser;


class Pemindahan extends BaseController
{
    protected $MKlasifikasi;
    protected $MArsip;
    protected $MArsipInaktif;
    protected $MPenyusutan;
    protected $MKmes2;
    protected $MKmbidang;
    protected $MKmsubbidang;
    protected $MUser;
    protected $MSubBidang;

    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MKlasifikasi     = new MKlasifikasi();
        $this->MArsip           = new MArsip();
        $this->MArsipInaktif    = new MArsipInaktif();
        $this->MPenyusutan      = new MPenyusutan();
        $this->MKmes2           = new MKmes2();
        $this->MKmbidang        = new MKmbidang();
        $this->MKmsubbidang     = new MKmsubbidang();
        $this->MUser            = new MUser();
    }
    public function getInaktif()
    {
        $id = session()->get('id');

        $arsipModel = new MArsip();
        $data['arsip_inaktif'] = $arsipModel->getArsipInaktif($id);

        // Mengembalikan data dalam format JSON
        return $this->response->setJSON($data['arsip_inaktif']);
    }
    public function index()
    {
        $data = [
            'judul'     => 'pemindahan',
            'subjudul'  => 'data retensi',
            'isi'       => 'pemindahan/retensi',
            'dataKlas'  => $this->MKlasifikasi->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function data()
    {
        $id = session()->get('id');

        $data = [
            'judul'         => 'pemindahan',
            'subjudul'      => 'data pemindahan',
            'isi'           => 'pemindahan/data',
            'dataPindah'    => $this->MPenyusutan->dataPindah($id),
            'dataKlas'      => $this->MKlasifikasi->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function getBidang($id_unit)
    {
        $bidangs = $this->MKmbidang->where('id_es2', $id_unit)->findAll();

        return $this->response->setJSON($bidangs);
    }

    public function getSubBidang($id_bidang)
    {
        $subBidangs = $this->MKmsubbidang->where('id_bidang', $id_bidang)->findAll();

        return $this->response->setJSON($subBidangs);
    }
    public function tambah()
    {
        $id = session()->get('id');
        $id_user = session()->get('id');

        $data = [
            'judul'         => 'pemindahan',
            'subjudul'      => 'tambah data',
            'isi'           => 'pemindahan/tambah',
            'data_user'     => $this->MUser->dataUser($id_user),
            'getArsipExp'   => $this->MArsip->getArsipExp($id),
            'units'         => $this->MKmes2->findAll(),
            'dataPindah'    => $this->MPenyusutan->dataPindah($id),
            'dataKlas'      => $this->MKlasifikasi->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function getArsipRetensi()
    {
        $id = session()->get('id');

        $arsipModel = new MArsip();
        $data = $arsipModel->getArsipExp($id);

        // Format data untuk DataTables
        $result = array(
            "data" => $data
        );

        return $this->response->setJSON($result);
    }
    public function usul_pindah()
    {
        $id = session()->get('id');
        $MSubBidang = new MSubBidang();
        $data = [
            'judul'             => 'pemindahan',
            'subjudul'          => 'tambah data',
            'arsipAktif'        => $this->MArsip->getArsipInaktif($id),
            'isi'               => 'pemindahan/add',
            'data_user'         => $this->MUser->dataUser($id),
            'subbidang'         => $MSubBidang->idData($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function pindah()
    {
        $idArsipList = $this->request->getPost('id_arsip'); // Ambil array ID arsip yang dipilih
        $noBa = $this->request->getPost('no_ba');
        $tglPindah = $this->request->getPost('tgl_pindah');
        $tglVerifikasi = $this->request->getPost('tgl_verifikasi');

        if (empty($idArsipList)) {
            return redirect()->back()->with('error', 'Tidak ada arsip yang dipilih.');
        }

        foreach ($idArsipList as $idArsip) {
            // Ambil data arsip dari tabel_aktif
            $arsip = $this->aktifModel->find($idArsip);
            $id_u = session()->get('id');

            if ($arsip) {
                if ($noBa && $tglVerifikasi) {
                    // Simpan arsip ke tabel_inaktif
                    $this->inaktifModel->insert([
                        'judul_dokumen' => $arsip['judul_dokumen'],
                        'tgl_dokumen' => $arsip['tgl_dokumen'],
                        'status' => 'inaktif'
                    ]);

                    // Hapus arsip dari tabel_aktif
                    $this->aktifModel->delete($idArsip);

                    // Simpan transaksi ke tabel_lamp_pindah
                    $this->lampPindahModel->insert([
                        'id_user' => $id_u,
                        'id_arsip' => $idArsip,
                        'no_ba' => $noBa,
                        'tgl_pindah' => $tglPindah,
                        'tgl_verifikasi' => $tglVerifikasi,
                        'cek_verif' => 'sudah'
                    ]);
                } else {
                    // Update status di tabel_aktif menjadi "usul_pindah"
                    $this->aktifModel->update($idArsip, ['status' => 'usul_pindah']);

                    // Simpan transaksi ke tabel_lamp_pindah dengan cek_verif sebagai 'belum'
                    $this->lampPindahModel->insert([
                        'id_arsip' => $idArsip,
                        'no_ba' => $noBa,
                        'tgl_pindah' => $tglPindah,
                        'tgl_verifikasi' => $tglVerifikasi,
                        'cek_verif' => 'belum'
                    ]);
                }
            } else {
                return redirect()->back()->with('error', 'Arsip dengan ID ' . $idArsip . ' tidak ditemukan.');
            }
        }

        return redirect()->back()->with('message', 'Proses pemindahan arsip selesai.');
    }
}

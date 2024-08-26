<?php

namespace App\Controllers;

use App\Models\MArsip;
use App\Models\MPeminjaman;
use App\Models\MLampPeminjaman;
use CodeIgniter\Controller;
use DateTime;

class Peminjaman extends Controller
{
    protected $MArsip;
    protected $MPeminjaman;
    protected $MLampPeminjaman;

    public function __construct()
    {
        $this->MArsip = new MArsip();
        $this->MPeminjaman = new MPeminjaman();
        $this->MLampPeminjaman = new MLampPeminjaman();
    }

    public function index()
    {
        $id = session()->get('id');
        $model = new MPeminjaman();

        $data = [
            'judul'         => 'Sirkulasi',
            'subjudul'      => 'Peminjaman',
            'isi'           => 'peminjaman/index',
        ];
        return view('layout/wrapper', $data);
    }
    public function getData()
    {
        $model = new MPeminjaman();
        $data = $model->findAll();

        foreach ($data as &$item) {
            $tglPinjam = new \DateTime($item['tgl_pinjam']);
            $tglKembali = new \DateTime($item['tgl_kembali']);
            $interval = $tglPinjam->diff($tglKembali);
            $item['range_pinjam'] = $interval->days;
        }

        return $this->response->setJSON($data);
    }
    public function tambah()
    {
        $model = new MPeminjaman();
        $id_user = session()->get('id');
        $data = [
            'judul'         => 'Sirkulasi',
            'subjudul'      => 'Peminjaman',
            'isi'           => 'peminjaman/add',
            'arsipList'     => $this->MArsip->getDataPinjam($id_user),
            'data'          => json_encode($model->where('id_user', $id_user)->findAll())

        ];
        return view('layout/wrapper', $data);
    }
    public function save()
    {
        // Validasi data input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_pinjam'     => 'required',
            'nip_peminjam'  => 'required',
            'nama_peminjam' => 'required',
            'tgl_pinjam'    => 'required|valid_date[Y-m-d]',
            'tgl_kembali'   => 'required|valid_date[Y-m-d]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // Inisialisasi model
        $model          = new MPeminjaman();
        $lampiranModel  = new MLampPeminjaman();
        $id = session()->get('id');

        // Hitung selisih hari
        $tglPinjam = $this->request->getPost('tgl_pinjam');
        $tglKembali = $this->request->getPost('tgl_kembali');
        $datePinjam = new \DateTime($tglPinjam);
        $dateKembali = new \DateTime($tglKembali);
        $interval = $datePinjam->diff($dateKembali);
        $rangePinjam = $interval->days;

        // Data yang akan disimpan ke tabel pinjam_arsip
        // Ambil data input
        $data = [
            'id_user'       => $id,
            'no_pinjam'     => $this->request->getPost('no_pinjam'),
            'nip_peminjam'  => $this->request->getPost('nip_peminjam'),
            'nama_peminjam' => $this->request->getPost('nama_peminjam'),
            'tgl_pinjam'    => $tglPinjam,
            'tgl_kembali'   => $tglKembali,
            'range_pinjam'  => $rangePinjam,
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        // Insert data pinjam arsip dan dapatkan id yang baru saja diinput
        // var_dump($data);
        $model->insert($data);
        $noPinjam       = $this->request->getPost('no_pinjam');
        $lampiranArsip  = $this->request->getPost('id_arsip');
        if ($lampiranArsip) {
            foreach ($lampiranArsip as $id_arsip) {
                $lampiranData = [
                    'no_pinjam' => $noPinjam,
                    'id_arsip'  => $id_arsip
                ];

                $lampiranModel->insert($lampiranData);
            }
        }
        $session = session();
        $session->setFlashdata('success', 'Data peminjaman berhasil disimpan.');
        return redirect()->to('peminjaman');
    }
    // Fungsi untuk menampilkan detail peminjaman arsip
    public function detail($noPinjam)
    {
        $pinjamModel = new MPeminjaman();
        $lampiranModel = new MLampPeminjaman();

        // Ambil data peminjaman berdasarkan no_pinjam
        $pinjam = $pinjamModel->where('no_pinjam', $noPinjam)->first();

        if (!$pinjam) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Peminjaman dengan no pinjam $noPinjam tidak ditemukan.");
        }

        // Ambil data lampiran berdasarkan no_pinjam
        $lampiran = $lampiranModel->where('no_pinjam', $noPinjam)->findAll();

        // Gabungkan data lampiran dengan data arsip
        $arsipModel = new MArsip();
        foreach ($lampiran as &$item) {
            $arsip = $arsipModel->find($item['id_arsip']);
            $item['judul_dokumen']  = $arsip['judul_dokumen'];
            $item['no_dokumen']     = $arsip['no_dokumen'];
            $item['tgl_dokumen']    = $arsip['tgl_dokumen'];
        }

        $data['pinjam'] = $pinjam;
        $data['lampiran'] = $lampiran;

        return view('peminjaman/detail', $data);
    }
    public function print($id)
    {
        $model = new MPeminjaman();
        $lampiranModel = new MLampPeminjaman();
        $arsipModel = new MArsip();

        // Data peminjaman berdasarkan id
        $pinjamArsip = $model->find($id);

        // Data arsip yang dipinjam berdasarkan id_pindah
        $lampiran = $lampiranModel->where('id_pinjam', $id)->findAll();

        $arsipList = [];
        foreach ($lampiran as $lampiranItem) {
            $arsip = $arsipModel->find($lampiranItem['id_arsip']);
            if ($arsip) {
                $arsipList[] = $arsip;
            }
        }

        return view('peminjaman/print', [
            'pinjam_arsip' => $pinjamArsip,
            'arsip_list' => $arsipList
        ]);
    }
    public function edit($id)
    {
        $model = new MPeminjaman();
        $lampiranModel = new MLampPeminjaman();
        $id_user = session()->get('id');

        $data = [
            'judul'         => 'Sirkulasi',
            'subjudul'      => 'Peminjaman',
            'isi'           => 'peminjaman/edit',
            'idarsip'       => $model->find($id),
            'arsipList'     => $this->MArsip->getDataPinjam($id_user),
        ];
        $data['lampiran'] = $lampiranModel->where('no_pinjam', $data['idarsip']['no_pinjam'])->findAll();

        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        $pinjamModel = new MPeminjaman();
        $lampiranModel = new MLampPeminjaman();

        // Hitung selisih hari
        $tglPinjam = $this->request->getPost('tgl_pinjam');
        $tglKembali = $this->request->getPost('tgl_kembali');
        $datePinjam = new \DateTime($tglPinjam);
        $dateKembali = new \DateTime($tglKembali);
        $interval   = $datePinjam->diff($dateKembali);
        $rangePinjam = $interval->days;

        // Data yang akan disimpan ke tabel pinjam_arsip
        // Ambil data input
        $pinjamData = [
            'id_user'       => $id,
            'no_pinjam'     => $this->request->getPost('no_pinjam'),
            'nip_peminjam'  => $this->request->getPost('nip_peminjam'),
            'nama_peminjam' => $this->request->getPost('nama_peminjam'),
            'tgl_pinjam'    => $tglPinjam,
            'tgl_kembali'   => $tglKembali,
            'range_pinjam'  => $rangePinjam,
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $pinjamModel->update($id, $pinjamData);

        // Hapus lampiran yang lama
        $lampiranModel->where('no_pinjam', $pinjamData['no_pinjam'])->delete();

        // Tambahkan lampiran yang baru
        $arsipIds = $this->request->getPost('arsip_id');
        if ($arsipIds) {
            foreach ($arsipIds as $arsipId) {
                $lampiranModel->insert([
                    'no_pinjam' => $pinjamData['no_pinjam'],
                    'id_arsip'  => $arsipId
                ]);
            }
        }

        return redirect()->to(base_url('peminjaman'))->with('success', 'Data berhasil diupdate.');
    }
    public function delete($id)
    {
        // Cari data berdasarkan ID dan hapus jika ada
        if ($this->MPeminjaman->find($id)) {
            $this->MPeminjaman->delete($id);
            return redirect()->to(base_url('peminjaman'))->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to(base_url('peminjaman'))->with('error', 'Data tidak ditemukan.');
        }
    }
}

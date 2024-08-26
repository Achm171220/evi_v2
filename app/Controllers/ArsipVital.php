<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MArsip;
use App\Models\MArsipInaktif;
use App\Models\MBerkasAktif;
use App\Models\MUser;
use App\Models\MSubBidang;
use App\Models\MKlasifikasi;

use Irsyadulibad\DataTables\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class ArsipVital extends BaseController
{
    protected $MArsip;
    protected $MArsipInaktif;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->MArsip               = new MArsip();
        $this->MArsipInaktif        = new MArsipInaktif();
    }
    public function jsonVital()
    {
        // $session = session();
        $id = session()->get('id');
        $subBidangId = $this->request->getGet('sub_bidang_id');

        $query = DataTables::use('ev_item_aktif')
            ->select('ev_item_aktif.no_dokumen, ev_item_aktif.judul_dokumen, ev_item_aktif.tgl_dokumen, km_sub_bidang.nama_sub_bidang')
            ->join('km_sub_bidang', 'km_sub_bidang.id = ev_item_aktif.id_sub_bidang')
            ->where(['ev_item_aktif.id_user' => $id])
            ->where(['ev_item_aktif.jenis_arsip' => 'vital']);

        if ($subBidangId) {
            $query->where(['ev_item_aktif.id_sub_bidang' => $subBidangId]);
        }

        return $query->make(true);
    }
    public function getArsipData()
    {
        $request = \Config\Services::request();
        $subBidangId = $request->getPost('sub_bidang_id');

        $arsipModel = new MArsip();
        $data = $arsipModel->getArsipData($subBidangId);

        echo json_encode($data);
    }
    public function index()
    {
        $MSubBidang     = new MSubBidang();

        $id = session()->get('id');
        $data = [
            'judul'         => 'Arsip Vital',
            'subjudul'      => 'Arsip Vital',
            'isi'           => 'arsipvital/index',
            'sub_bidang'    => $MSubBidang->getID($id),
            'data'          => $this->MArsip->arsipVital($id)
            // 'data'          => $this->MArsip->where('jenis_arsip', 'vital')->where('id_user', $id)
        ];
        return view('layout/wrapper', $data);
        // return view('arsipvital/coba',$data);
    }
    public function importvital()
    {
        $file = $this->request->getFile('file');

        // Validasi file
        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();

            // Membaca file Excel
            $reader = new Xlsx();
            $spreadsheet = $reader->load($filePath);
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            // Validasi dan simpan data
            $data = [];
            foreach ($sheet as $index => $row) {
                // Contoh validasi: pastikan kolom name dan price tidak kosong
                if ($index === 0) {
                    continue; // Lanjut ke iterasi berikutnya
                }
                $data[] = [
                    'id_user'           => $row[0] ?? null,
                    'id_sub_bidang'     => $row[1] ?? null,
                    'id_berkas'         => $row[2] ?? null,
                    'id_klasifikasi'    => $row[3] ?? null,
                    'no_dokumen'        => $row[4] ?? null,
                    'judul_dokumen'     => $row[5] ?? null,
                    'tgl_dokumen'       => $row[6] ?? null,
                    'tahun_cipta'       => $row[7] ?? null,
                    'derajat_keamanan'  => $row[8] ?? null,
                    'jumlah'            => $row[9] ?? null,
                    'tk_perkembangan'   => $row[10] ?? null,
                    'lokasi_simpan'     => $row[11] ?? null,
                    'media_simpan'      => $row[12] ?? null,
                    'no_box'            => $row[13] ?? null,
                    'status_arsip'      => $row[14] ?? null,
                    'jenis_arsip'       => $row[15] ?? 'vital',
                    'nama_file'         => $row[16] ?? null,
                    'nama_folder'       => $row[17] ?? null,
                    'nama_link'         => $row[18] ?? null,
                    'tl_temuan'         => $row[19] ?? null,
                    'dasar_catat'       => $row[20] ?? 'daftar_arsip',
                ];
            }

            if (!empty($data)) {
                // Simpan ke database
                $this->MArsip->insertBatch($data);
                return redirect()->to(base_url('arsipvital'))->with('success', 'Data berhasil diimpor.');
            } else {
                return redirect()->to(base_url('arsipvital'))->with('error', 'Tidak ada data yang valid untuk diimpor.');
            }
        } else {
            return redirect()->to(base_url('arsipvital'))->with('error', 'File tidak valid.');
        }
    }
    public function tambah()
    {
        $id = session()->get('id');
        $MSubBidang         = new MSubBidang();
        $MKlasifikasi       = new MKlasifikasi();
        $MUser              = new MUser();
        $data = [
            'judul'         => 'Arsip Vital',
            'subjudul'      => 'Tambah Arsip',
            'isi'           => 'arsipvital/add',
            'SubBidang'     => $MSubBidang->allData(),
            'getIdSub'      => $MSubBidang->getID($id),
            'klasifikasi'   => $MKlasifikasi->allData(),
            'data_user'     => $MUser->dataUser($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function store()
    {
        $MArsip     = new MArsip();
        $id = session()->get('id');
        $data = [
            'id_user'                => $id,
            'id_sub_bidang'            => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'        => $this->request->getPost('id_klasifikasi'),
            'no_dokumen'            => $this->request->getPost('no_dokumen'),
            'judul_dokumen'            => $this->request->getPost('judul_dokumen'),
            'tgl_dokumen'            => $this->request->getPost('tgl_dokumen'),
            'tahun_cipta'            => $this->request->getPost('tahun_cipta'),
            'jumlah'                => $this->request->getPost('jumlah'),
            'tk_perkembangan'        => $this->request->getPost('tk_perkembangan'),
            'lokasi_simpan'            => $this->request->getPost('lokasi_simpan'),
            'media_simpan'            => $this->request->getPost('media_simpan'),
            'no_box'                => $this->request->getPost('no_box'),
            'status_arsip'            => $this->request->getPost('status_arsip'),
            'jenis_arsip'            => $this->request->getPost('jenis_arsip'),
            'nama_file'                => $this->request->getPost('nama_file'),
            'nama_folder'            => $this->request->getPost('nama_folder'),
            'nama_link'                => $this->request->getPost('nama_link'),
            'status_siklus'            => $this->request->getPost('status_siklus'),
            'tl_temuan'                => $this->request->getPost('tl_temuan'),
            'dasar_catat'            => $this->request->getPost('dasar_catat'),
            'pinjam'                => $this->request->getPost('pinjam'),
        ];
        $MArsip->insert($data);

        session()->setFlashdata('success', 'Data berhasil ditambah!');
        return redirect()->to(base_url('arsip'));
    }
    public function edit($id)
    {
        //model initialize

        $MArsip         = new MArsip();
        $MSubBidang     = new MSubBidang();
        $MKlasifikasi     = new MKlasifikasi();
        $MUser             = new MUser();

        $id_u = session()->get('id');
        $data = array(
            'judul'         => 'Arsip',
            'subjudul'         => 'AddArsip',
            'isi'           => 'arsip/edit',
            'dataId'        => $MArsip->find($id),
            'SubBidang'        => $MSubBidang->allData(),
            'idSubBidang'    => $MSubBidang->idData($id),
            'dataSubBidang'    => $MSubBidang->getID($id_u),
            'klasifikasi'    => $MKlasifikasi->allData(),
            'IdData'        => $MArsip->getIdData($id),
            'data_user'        => $MUser->dataUser($id_u),

        );

        return view('layout/wrapper', $data);
    }
    public function update($id_arsip)
    {
        $MArsip     = new MArsip();
        $id = session()->get('id');

        $data = [
            'id'                    => $id_arsip,
            'id_user'                => $id,
            'id_sub_bidang'            => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'        => $this->request->getPost('id_klasifikasi'),
            'no_dokumen'            => $this->request->getPost('no_dokumen'),
            'judul_dokumen'            => $this->request->getPost('judul_dokumen'),
            'tgl_dokumen'            => $this->request->getPost('tgl_dokumen'),
            'tahun_cipta'            => $this->request->getPost('tahun_cipta'),
            'jumlah'                => $this->request->getPost('jumlah'),
            'tk_perkembangan'        => $this->request->getPost('tk_perkembangan'),
            'lokasi_simpan'            => $this->request->getPost('lokasi_simpan'),
            'media_simpan'            => $this->request->getPost('media_simpan'),
            'no_box'                => $this->request->getPost('no_box'),
            'status_arsip'            => $this->request->getPost('status_arsip'),
            'jenis_arsip'            => $this->request->getPost('jenis_arsip'),
            'nama_file'                => $this->request->getPost('nama_file'),
            'nama_folder'            => $this->request->getPost('nama_folder'),
            'nama_link'                => $this->request->getPost('nama_link'),
            'status_siklus'            => $this->request->getPost('status_siklus'),
            'tl_temuan'                => $this->request->getPost('tl_temuan'),
            'dasar_catat'            => $this->request->getPost('dasar_catat'),
            'pinjam'                => $this->request->getPost('pinjam'),
        ];
        // print_r($data);
        // var_dump($data);
        $MArsip->update($id_arsip, $data);

        session()->setFlashdata('success', 'Data berhasil diupdate!');
        return redirect()->to(base_url('arsip'));
    }
    public function delete($id)
    {
        $model = new MArsip();
        if ($model->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Penghapusan data gagal');
        }
        return redirect()->to(base_url('arsipvital'));
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MArsip;
use App\Models\MArsipInaktif;
use Irsyadulibad\DataTables\DataTables;
use App\Models\MUser;
use App\Models\MSubBidang;
use App\Models\MKlasifikasi;

// library phpspreadsheet 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use CodeIgniter\API\ResponseTrait;


class ArsipInaktif extends BaseController
{
    protected $MArsip;
    protected $MUser;
    protected $MSubBidang;
    protected $MKlasifikasi;
    protected $MArsipInaktif;
    use ResponseTrait;

    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MArsip               = new MArsip();
        $this->MUser                = new MUser();
        $this->MArsipInaktif        = new MArsipInaktif();
    }
    public function json()
    {
        // $session = session();
        $id = session()->get('id');
        if ($id == null) {
            return view('auth/login');
        } else {
            return DataTables::use('ev_item_inaktif')
                ->select('ev_item_inaktif.id as id, id_user, km_sub_bidang.nama_sub_bidang as sub_bidang, km_klasifikasi.kode_klasifikasi as kode_klas, judul_dokumen, no_dokumen, tgl_dokumen, media_simpan, jenis_arsip')
                ->join('km_sub_bidang', 'ev_item_inaktif.id_sub_bidang = km_sub_bidang.id', 'INNER JOIN')
                ->join('km_klasifikasi', 'ev_item_inaktif.id_klasifikasi = km_klasifikasi.id', 'INNER JOIN')
                ->where(['id_user' => $id])
                // ->join('km_sub_bidang', 'id', 'left')
                ->make(true);
        }
    }
    public function index()
    {
        $id = session()->get('id');
        if ($id == null) {
            return view('auth/login');
        } else {
            $MUser             = new MUser();
            $data = [
                'judul'         => 'Inaktif',
                'subjudul'      => 'Item Arsip Inaktif',
                'isi'           => 'arsipinaktif/index',
                'data_user'     => $MUser->dataUser($id),
            ];
            return view('layout/wrapper', $data);
        }
    }
    public function tambah()
    {

        $id = session()->get('id');
        $MSubBidang         = new MSubBidang();
        $MKlasifikasi       = new MKlasifikasi();
        $MUser              = new MUser();
        $data = [
            'judul'             => 'Inaktif',
            'subjudul'          => 'Tambah Arsip Inaktif',
            'isi'               => 'arsipinaktif/add',
            'SubBidang'         => $MSubBidang->allData(),
            'getIdSub'          => $MSubBidang->getID($id),
            'klasifikasi'       => $MKlasifikasi->allData(),
            'data_user'         => $MUser->dataUser($id),
        ];
        return view('layout/wrapper', $data);
    }
    public function store()
    {
        $MArsipInaktif     = new MArsipInaktif();
        $id = session()->get('id');
        $data = [
            'id_user'                   => $id,
            'id_sub_bidang'             => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'            => $this->request->getPost('id_klasifikasi'),
            'no_dokumen'                => $this->request->getPost('no_dokumen'),
            'judul_dokumen'             => $this->request->getPost('judul_dokumen'),
            'tgl_dokumen'               => $this->request->getPost('tgl_dokumen'),
            'tahun_cipta'               => $this->request->getPost('tahun_cipta'),
            'jumlah'                    => $this->request->getPost('jumlah'),
            'tk_perkembangan'           => $this->request->getPost('tk_perkembangan'),
            'lokasi_simpan'             => $this->request->getPost('lokasi_simpan'),
            'media_simpan'              => $this->request->getPost('media_simpan'),
            'no_box'                    => $this->request->getPost('no_box'),
            'status_arsip'              => $this->request->getPost('status_arsip'),
            'jenis_arsip'               => $this->request->getPost('jenis_arsip'),
            'nama_file'                 => $this->request->getPost('nama_file'),
            'nama_folder'               => $this->request->getPost('nama_folder'),
            'nama_link'                 => $this->request->getPost('nama_link'),
            'status_siklus'             => $this->request->getPost('status_siklus'),
            'tl_temuan'                 => $this->request->getPost('tl_temuan'),
            'dasar_catat'               => $this->request->getPost('dasar_catat'),
            'pinjam'                    => $this->request->getPost('pinjam'),
        ];
        $MArsipInaktif->insert($data);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan!');
        return redirect()->to(base_url('arsipinaktif'));
    }
    public function edit($id)
    {
        //model initialize

        $MArsip         = new MArsipInaktif();
        $MSubBidang     = new MSubBidang();
        $MKlasifikasi     = new MKlasifikasi();
        $MUser             = new MUser();

        $id_u = session()->get('id');
        $data = array(
            'judul'             => 'Arsip Inaktif',
            'subjudul'          => 'AddArsip',
            'isi'               => 'arsipinaktif/edit',
            'dataId'            => $MArsip->find($id),
            'SubBidang'         => $MSubBidang->allData(),
            'idSubBidang'       => $MSubBidang->idData($id),
            'dataSubBidang'     => $MSubBidang->getID($id_u),
            'klasifikasi'       => $MKlasifikasi->allData(),
            'IdData'            => $MArsip->getIdData($id),
            'data_user'         => $MUser->dataUser($id_u),

        );

        return view('layout/wrapper', $data);
    }
    public function update($id_arsip)
    {
        $MArsip     = new MArsipInaktif();
        $id = session()->get('id');

        $data = [
            'id'                        => $id_arsip,
            'id_user'                   => $id,
            'id_sub_bidang'             => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'            => $this->request->getPost('id_klasifikasi'),
            'no_dokumen'                => $this->request->getPost('no_dokumen'),
            'judul_dokumen'             => $this->request->getPost('judul_dokumen'),
            'tgl_dokumen'               => $this->request->getPost('tgl_dokumen'),
            'tahun_cipta'               => $this->request->getPost('tahun_cipta'),
            'jumlah'                    => $this->request->getPost('jumlah'),
            'tk_perkembangan'           => $this->request->getPost('tk_perkembangan'),
            'lokasi_simpan'             => $this->request->getPost('lokasi_simpan'),
            'media_simpan'              => $this->request->getPost('media_simpan'),
            'no_box'                    => $this->request->getPost('no_box'),
            'status_arsip'              => $this->request->getPost('status_arsip'),
            'jenis_arsip'               => $this->request->getPost('jenis_arsip'),
            'nama_file'                 => $this->request->getPost('nama_file'),
            'nama_folder'               => $this->request->getPost('nama_folder'),
            'nama_link'                 => $this->request->getPost('nama_link'),
            'status_siklus'             => $this->request->getPost('status_siklus'),
            'tl_temuan'                 => $this->request->getPost('tl_temuan'),
            'dasar_catat'               => $this->request->getPost('dasar_catat'),
            'pinjam'                    => $this->request->getPost('pinjam'),
        ];
        // print_r($data);
        // var_dump($data);
        $MArsip->update($id_arsip, $data);

        session()->setFlashdata('success', 'Data berhasil diupdate!');
        return redirect()->to(base_url('arsipinaktif'));
    }
    // DAFTAR ARSIP  
    public function daftarArsip()
    {
        $id = session()->get('id');
        $arsip     = new MArsipInaktif();
        $user       = new MUser();

        $data = [
            'judul'         => 'Inaktif',
            'subjudul'      => 'Daftar Arsip Inaktif',
            'daftar'        => $arsip->daftarArsip($id),
            'data_user'     => $user->dataUser($id),
            'isi'           => 'arsipinaktif/daftar_arsip'
        ];
        return view('layout/wrapper', $data);
    }
    // ARSIP VITAL 
    public function arsipVital()
    {

        $id_user = session()->get('id');
        $data = [
            'subjudul'          => 'Arsip Vital',
            'isi'               => 'vital/index',
            'data_user'         => $this->MUser->dataUser($id_user),
            'arsipVital'        => $this->MArsip->arsipVital($id_user),
        ];
        return view('layout/wrapper', $data);
    }
    // export excel daftar arsip inaktif 
    public function exportExcel()
    {
        $id = session()->get('id');

        $arsipModel = new MArsipInaktif();
        $arsipData = $arsipModel->daftarArsip($id);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul "Daftar Arsip"
        $sheet->setCellValue('A1', 'Daftar Arsip Inaktif');
        $sheet->mergeCells('A1:I1'); // Menggabungkan sel A1 hingga E1
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header di Excel
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Id_user');
        $sheet->setCellValue('C2', 'Kode Klasifikasi');
        $sheet->setCellValue('D2', 'No Berkas');
        $sheet->setCellValue('E2', 'Nama Berkas');
        $sheet->setCellValue('F2', 'Nomor Item Berkas');
        $sheet->setCellValue('G2', 'Uraian Informasi');
        $sheet->setCellValue('H2', 'Kurun Waktu');
        $sheet->setCellValue('I2', 'Derajat Keamanan');
        $sheet->setCellValue('J2', 'Jumlah');
        $sheet->setCellValue('K2', 'Tingkat Perkembangan');
        $sheet->setCellValue('L2', 'Lokasi Simpan');
        $sheet->setCellValue('M2', 'Media Simpan');
        $sheet->setCellValue('N2', 'No Box');
        $sheet->setCellValue('O2', 'Dasar Catat');
        $sheet->setCellValue('P2', 'Jenis Arsip');

        $sheet->getStyle('A2:P2')->getFont()->setBold(true);
        $sheet->getStyle('A2:P2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:P2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');

        $row = 3;
        $no = 1;
        foreach ($arsipData as $arsip) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $arsip['id_user']);
            $sheet->setCellValue('C' . $row, $arsip['kode_klasifikasi']);
            $sheet->setCellValue('D' . $row, $arsip['no_berkas']);
            $sheet->setCellValue('E' . $row, $arsip['nama_berkas']);
            $sheet->setCellValue('G' . $row, $arsip['no_dokumen']);
            $sheet->setCellValue('F' . $row, $arsip['judul_dokumen']);
            $sheet->setCellValue('H' . $row, $arsip['tgl_dokumen']);
            $sheet->setCellValue('I' . $row, $arsip['derajat_keamanan']);
            $sheet->setCellValue('J' . $row, $arsip['jumlah']);
            $sheet->setCellValue('K' . $row, $arsip['tk_perkembangan']);
            $sheet->setCellValue('L' . $row, $arsip['lokasi_simpan']);
            $sheet->setCellValue('M' . $row, $arsip['media']);
            $sheet->setCellValue('N' . $row, $arsip['no_box']);
            $sheet->setCellValue('O' . $row, $arsip['dasar_catat']);
            $sheet->setCellValue('P' . $row, $arsip['jenis_arsip']);
            // Mengatur alignment rata kiri untuk setiap sel
            $sheet->getStyle('A' . $row . ':P' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $row++;
        }
        // Menambahkan bagian tanda tangan
        $lastRow = $row + 2; // Baris untuk bagian tanda tangan

        // Baris untuk "Disusun oleh"
        $sheet->setCellValue('L' . $lastRow, 'Disusun oleh:');
        $sheet->mergeCells('L' . $lastRow . ':P' . $lastRow);
        $sheet->getStyle('L' . $lastRow)->getFont()->setBold(true);
        $sheet->getStyle('L' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Baris untuk nama penyusun (kosong untuk diisi)
        $sheet->setCellValue('L' . ($lastRow + 1), 'Nama Arsiparis'); // Nama penyusun baris 1
        $sheet->mergeCells('L' . ($lastRow + 1) . ':P' . ($lastRow + 1));

        $sheet->setCellValue('L' . ($lastRow + 2), 'Nama Arsiparis'); // Nama penyusun baris 2
        $sheet->mergeCells('L' . ($lastRow + 2) . ':P' . ($lastRow + 2));

        // Membuat file Excel
        $writer = new Xlsx($spreadsheet);
        $date = date('Y-m-d H:i:s');
        $filename = 'daftar_arsipinaktif' . $date . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}

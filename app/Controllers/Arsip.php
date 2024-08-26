<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MArsip;
use App\Models\MBerkasAktif;
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
// librar dompdf 
use Dompdf\Dompdf;
use Dompdf\Options;

use CodeIgniter\API\ResponseTrait;


class Arsip extends BaseController
{
	protected $MArsip;
	protected $MUser;
	protected $MSubBidang;
	protected $MKlasifikasi;
	use ResponseTrait;

	public function __construct()
	{
		helper('form', 'url', 'download');
		$this->MArsip		= new MArsip();
		$this->MUser		= new MUser();
	}
	public function json()
	{
		// $session = session();
		$id = session()->get('id');

		return DataTables::use('ev_item_aktif')
			->select('ev_item_aktif.id as id, id_user, km_sub_bidang.nama_sub_bidang as sub_bidang, km_klasifikasi.kode_klasifikasi as kode_klas, judul_dokumen, no_dokumen, tgl_dokumen, media_simpan, jenis_arsip')
			->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang = km_sub_bidang.id', 'left JOIN')
			->join('km_klasifikasi', 'ev_item_aktif.id_klasifikasi = km_klasifikasi.id', 'left JOIN')
			->where(['id_user' => $id])
			// ->join('km_sub_bidang', 'id', 'left')
			// ->addColumn('action', function ($data) {
			// 	return '<a href="/edit/' . $data->id . '">edit</a>';
			// })
			->make(true);
	}

	public function index()
	{
		$id = session()->get('id');
		if ($id == null) {
			return view('auth/login');
		} elseif (session()->get('id') !== '1') {
			// jika tidak admin 
			$MUser 			= new MUser();
			$data = [
				'judul' 	=> 'Arsip',
				'subjudul' 	=> 'Item Berkas',
				'isi'   	=> 'arsip/index',
				'data_user'	=> $MUser->dataUser($id),
			];
			return view('layout/wrapper', $data);
		} else {
			// jika admin 
			$MUser 			= new MUser();
			$data = [
				'judul' 	=> 'Arsip',
				'subjudul' 	=> 'Item Berkas',
				'isi'   	=> 'arsip/admin',
				'data_user'	=> $MUser->dataUser($id),
			];
			return view('layout/wrapper', $data);
		}
	}
	public function tambah()
	{
		$id = session()->get('id');
		$MSubBidang 	= new MSubBidang();
		$MKlasifikasi 	= new MKlasifikasi();
		$MUser 			= new MUser();
		$data = [
			'judul' 		=> 'Arsip',
			'subjudul' 		=> 'Tambah Arsip',
			'isi'   		=> 'arsip/add',
			'SubBidang'		=> $MSubBidang->allData(),
			'getIdSub'		=> $MSubBidang->getID($id),
			'klasifikasi'	=> $MKlasifikasi->allData(),
			'data_user'		=> $MUser->dataUser($id),
		];
		return view('layout/wrapper', $data);
	}
	public function store()
	{
		$MArsip 	= new MArsip();
		$id = session()->get('id');
		$data = [
			'id_user'				=> $id,
			'id_sub_bidang'			=> $this->request->getPost('id_sub_bidang'),
			'id_klasifikasi'		=> $this->request->getPost('id_klasifikasi'),
			'no_dokumen'			=> $this->request->getPost('no_dokumen'),
			'judul_dokumen'			=> $this->request->getPost('judul_dokumen'),
			'tgl_dokumen'			=> $this->request->getPost('tgl_dokumen'),
			'tahun_cipta'			=> $this->request->getPost('tahun_cipta'),
			'jumlah'				=> $this->request->getPost('jumlah'),
			'tk_perkembangan'		=> $this->request->getPost('tk_perkembangan'),
			'lokasi_simpan'			=> $this->request->getPost('lokasi_simpan'),
			'media_simpan'			=> $this->request->getPost('media_simpan'),
			'no_box'				=> $this->request->getPost('no_box'),
			'status_arsip'			=> $this->request->getPost('status_arsip'),
			'jenis_arsip'			=> $this->request->getPost('jenis_arsip'),
			'nama_file'				=> $this->request->getPost('nama_file'),
			'nama_folder'			=> $this->request->getPost('nama_folder'),
			'nama_link'				=> $this->request->getPost('nama_link'),
			'status_siklus'			=> $this->request->getPost('status_siklus'),
			'tl_temuan'				=> $this->request->getPost('tl_temuan'),
			'dasar_catat'			=> $this->request->getPost('dasar_catat'),
			'pinjam'				=> $this->request->getPost('pinjam'),
		];
		$MArsip->insert($data);

		session()->setFlashdata('success', 'Data berhasil ditambah!');
		return redirect()->to(base_url('arsip'));
	}
	public function edit($id)
	{
		//model initialize

		$MArsip 		= new MArsip();
		$MSubBidang 	= new MSubBidang();
		$MKlasifikasi 	= new MKlasifikasi();
		$MUser 			= new MUser();

		$id_u = session()->get('id');
		$data = array(
			'judul' 		=> 'Arsip',
			'subjudul' 		=> 'AddArsip',
			'isi'       	=> 'arsip/edit',
			'dataId'    	=> $MArsip->find($id),
			'SubBidang'		=> $MSubBidang->allData(),
			'idSubBidang'	=> $MSubBidang->idData($id),
			'dataSubBidang'	=> $MSubBidang->getID($id_u),
			'klasifikasi'	=> $MKlasifikasi->allData(),
			'IdData'		=> $MArsip->getIdData($id),
			'data_user'		=> $MUser->dataUser($id_u),

		);

		return view('layout/wrapper', $data);
	}
	public function update($id_arsip)
	{
		$MArsip 	= new MArsip();
		$id = session()->get('id');

		$data = [
			'id'					=> $id_arsip,
			'id_user'				=> $id,
			'id_sub_bidang'			=> $this->request->getPost('id_sub_bidang'),
			'id_klasifikasi'		=> $this->request->getPost('id_klasifikasi'),
			'no_dokumen'			=> $this->request->getPost('no_dokumen'),
			'judul_dokumen'			=> $this->request->getPost('judul_dokumen'),
			'tgl_dokumen'			=> $this->request->getPost('tgl_dokumen'),
			'tahun_cipta'			=> $this->request->getPost('tahun_cipta'),
			'jumlah'				=> $this->request->getPost('jumlah'),
			'tk_perkembangan'		=> $this->request->getPost('tk_perkembangan'),
			'lokasi_simpan'			=> $this->request->getPost('lokasi_simpan'),
			'media_simpan'			=> $this->request->getPost('media_simpan'),
			'no_box'				=> $this->request->getPost('no_box'),
			'status_arsip'			=> $this->request->getPost('status_arsip'),
			'jenis_arsip'			=> $this->request->getPost('jenis_arsip'),
			'nama_file'				=> $this->request->getPost('nama_file'),
			'nama_folder'			=> $this->request->getPost('nama_folder'),
			'nama_link'				=> $this->request->getPost('nama_link'),
			'status_siklus'			=> $this->request->getPost('status_siklus'),
			'tl_temuan'				=> $this->request->getPost('tl_temuan'),
			'dasar_catat'			=> $this->request->getPost('dasar_catat'),
			'pinjam'				=> $this->request->getPost('pinjam'),
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
		return redirect()->to(base_url('arsip'));
	}
	// DAFTAR ARSIP  
	public function daftarArsip()
	{
		$id = session()->get('id');
		$arsip 	= new MArsip();
		$user 	= new MUser();

		$data = [
			'judul' 	=> 'Arsip',
			'subjudul' 	=> 'Daftar Arsip',
			'daftar' 	=> $arsip->daftarArsip($id),
			'data_user'	=> $user->dataUser($id),
			'isi'		=> 'arsip/daftar_arsip'
		];
		return view('layout/wrapper', $data);
	}
	// update id_berkas select box 
	public function update_id_berkas()
	{
		$model = new MArsip();
		$ids = $this->request->getPost('ids');
		$newIdBerkas = $this->request->getPost('new_id_berkas');

		$success = $model->updateIdBerkas($ids, $newIdBerkas);

		return $this->response->setJSON(['success' => $success]);
	}
	public function get_items()
	{
		$id_user = session()->get('id');

		$model = new MArsip();
		$data = $model->getItems($id_user);
		return $this->response->setJSON($data);
	}
	public function get_berkas_options()
	{
		$id_user = session()->get('id');

		$model = new MBerkasAktif(); // Gunakan model ini
		$data = $model->where('id_user', $id_user)->findAll();
		return $this->response->setJSON($data);
	}
	public function importArsip()
	{
		// Validasi file yang diupload
		if (!$this->validate([
			'file' => [
				'uploaded[file]',
				'mime_in[file,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
				'max_size[file,2048]',
			]
		])) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		// Ambil file yang diupload
		$file = $this->request->getFile('file');

		// Load spreadsheet
		$spreadsheet = IOFactory::load($file->getTempName());

		// Ambil data dari sheet pertama
		$sheet = $spreadsheet->getActiveSheet();
		$data = $sheet->toArray();

		// Siapkan data untuk diimpor
		$importData = [];

		// Mulai dari baris kedua (indeks 1) untuk mengabaikan baris pertama
		for ($i = 1; $i < count($data); $i++) {
			$row = $data[$i];

			// Pastikan data tidak kosong
			if (empty(array_filter($row))) {
				continue;
			}


			$importData[] = [
				'id_user'				=> $row[0] ?? null,
				'id_sub_bidang'			=> $row[1] ?? null,
				'id_berkas'				=> $row[2] ?? null,
				'id_klasifikasi'		=> $row[3] ?? null,
				'no_dokumen'			=> $row[4] ?? null,
				'judul_dokumen'			=> $row[5] ?? null,
				'tgl_dokumen'			=> $row[6] ?? null,
				'tahun_cipta'			=> $row[7] ?? null,
				'derajat_keamanan'		=> $row[8] ?? null,
				'jumlah'				=> $row[9] ?? null,
				'tk_perkembangan'		=> $row[10] ?? null,
				'lokasi_simpan'			=> $row[11] ?? null,
				'media_simpan'			=> $row[12] ?? null,
				'no_box'				=> $row[13] ?? null,
				'status_arsip'			=> $row[14] ?? null,
				'jenis_arsip'			=> $row[15] ?? null,
				'nama_file'				=> $row[16] ?? null,
				'nama_folder'			=> $row[17] ?? null,
				'nama_link'				=> $row[18] ?? null,
				'status_siklus'			=> $row[19] ?? null,
				'tl_temuan'				=> $row[20] ?? null,
				'dasar_catat'			=> $row[21] ?? 'daftar_arsip',
				'pinjam'				=> $row[22] ?? null,
			];
		}

		// Gunakan model untuk cek data yang sudah ada di database
		$arsipModel = new MArsip();
		$insertedCount = $arsipModel->insertIfNotExist($importData);

		// Tampilkan pesan data duplikat
		$message = ($insertedCount > 0) ? "$insertedCount data berhasil diimpor." : "Semua data sudah ada di database dan tidak diimpor.";

		return redirect()->to('arsip')->with('message', $message);

		// off sementara opsi B 

		// $file = $this->request->getFile('file');

		// // Validasi file
		// if ($file->isValid() && !$file->hasMoved()) {
		// 	$filePath = $file->getTempName();

		// 	// Membaca file Excel
		// 	$reader = new Xlsx();
		// 	$spreadsheet = $reader->load($filePath);
		// 	$sheet = $spreadsheet->getActiveSheet()->toArray();

		// 	// Validasi dan simpan data
		// 	$data = [];
		// 	foreach ($sheet as $index => $row) {
		// 		// Contoh validasi: pastikan kolom name dan price tidak kosong
		// 		if ($index === 0) {
		// 			continue; // Lanjut ke iterasi berikutnya
		// 		}
		// 		$data[] = [
		// 			// nama kolom => bari excel
		// 			'id_user'				=> $row[0] ?? null,
		// 			'id_sub_bidang'			=> $row[1] ?? null,
		// 			'id_berkas'				=> $row[2] ?? null,
		// 			'id_klasifikasi'		=> $row[3] ?? null,
		// 			'no_dokumen'			=> $row[4] ?? null,
		// 			'judul_dokumen'			=> $row[5] ?? null,
		// 			'tgl_dokumen'			=> $row[6] ?? null,
		// 			'tahun_cipta'			=> $row[7] ?? null,
		// 			'derajat_keamanan'		=> $row[8] ?? null,
		// 			'jumlah'				=> $row[9] ?? null,
		// 			'tk_perkembangan'		=> $row[10] ?? null,
		// 			'lokasi_simpan'			=> $row[11] ?? null,
		// 			'media_simpan'			=> $row[12] ?? null,
		// 			'no_box'				=> $row[13] ?? null,
		// 			'status_arsip'			=> $row[14] ?? null,
		// 			'jenis_arsip'			=> $row[15] ?? null,
		// 			'nama_file'				=> $row[16] ?? null,
		// 			'nama_folder'			=> $row[17] ?? null,
		// 			'nama_link'				=> $row[18] ?? null,
		// 			'status_siklus'			=> $row[19] ?? null,
		// 			'tl_temuan'				=> $row[20] ?? null,
		// 			'dasar_catat'			=> $row[21] ?? 'daftar_arsip',
		// 			'pinjam'				=> $row[22] ?? null,
		// 		];
		// 	}

		// 	if (!empty($data)) {
		// 		// Simpan ke database
		// 		$this->MArsip->insertBatch($data);
		// 		return redirect()->to(base_url('Arsip'))->with('success', 'Data berhasil diimpor.');
		// 	} else {
		// 		return redirect()->to(base_url('Arsip'))->with('error', 'Tidak ada data yang valid untuk diimpor.');
		// 	}
		// } else {
		// 	return redirect()->to(base_url('Arsip'))->with('error', 'File tidak valid.');
		// }
	}
	public function exportExcel()
	{
		$id = session()->get('id');

		$arsipModel = new MArsip();
		$arsipData = $arsipModel->daftarArsip($id);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Set judul "Daftar Arsip"
		$sheet->setCellValue('A1', 'Daftar Arsip Aktif');
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
		$filename = 'daftar_arsip' . $date . '.xlsx';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
		exit();
	}
	public function exportPDF()
	{
		$id = session()->get('id');

		$arsipModel = new MArsip();
		$arsipData = $arsipModel->daftarArsip($id);

		$dompdf = new Dompdf();

		$html = '<h1>Data Arsip</h1>';
		$html .= '<table border="1" width="100%">';
		$html .= '<tr><th>ID</th><th>Nama Berkas</th><th>No Berkas</th><th>Tanggal Berkas</th><th>Jenis Arsip</th></tr>';
		foreach ($arsipData as $arsip) {
			$html .= '<tr>';
			$html .= '<td>' . $arsip['id'] . '</td>';
			$html .= '<td>' . $arsip['nama_berkas'] . '</td>';
			$html .= '<td>' . $arsip['no_berkas'] . '</td>';
			$html .= '<td>' . $arsip['tanggal_berkas'] . '</td>';
			$html .= '<td>' . $arsip['jenis_arsip'] . '</td>';
			$html .= '</tr>';
		}
		$html .= '</table>';

		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream("arsip-data.pdf", array("Attachment" => 0));
	}
}

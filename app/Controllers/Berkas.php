<?php

namespace App\Controllers;

use App\Models\MBerkasAktif; // Ganti dengan nama model yang sesuai
use App\Models\MArsip; // Ganti dengan nama model yang sesuai
use App\Models\MSubBidang;
use App\Models\MUser;
use App\Models\MKlasifikasi;
use App\Models\MKmes2;

use CodeIgniter\Controller;
use Irsyadulibad\DataTables\DataTables;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use CodeIgniter\HTTP\ResponseInterface;

class Berkas extends Controller
{
    use ResponseTrait;
    protected $MBerkasAktif;
    protected $MSubBidang;
    protected $MUser;
    protected $MKlasifikasi;
    protected $MKmes2;
    protected $MArsip;
    protected $Spreadsheet;

    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MBerkasAktif     = new MBerkasAktif();
        $this->MSubBidang       = new MSubBidang();
        $this->MUser            = new MUser();
        $this->MKlasifikasi     = new MKlasifikasi();
        $this->MKmes2           = new MKmes2();
        $this->MArsip           = new MArsip();
        // $this->Spreadsheet      = new Spreadsheet();
    }
    public function json()
    {
        // $session = session();
        $id = session()->get('id');
        return DataTables::use('ev_berkas_aktif')
            ->select('ev_berkas_aktif.id as id, ev_berkas_aktif.id_user, km_sub_bidang.nama_sub_bidang as sub_bidang, km_klasifikasi.kode_klasifikasi as kode_klas, nama_berkas, tahun_berkas')
            ->join('km_sub_bidang', 'ev_berkas_aktif.id_sub_bidang = km_sub_bidang.id', 'LEFT JOIN')
            ->join('km_klasifikasi', 'ev_berkas_aktif.id_klasifikasi = km_klasifikasi.id', 'LEFT JOIN')
            // ->join('ev_item_aktif', 'ev_item_aktif.id_berkas = ev_berkas_aktif.id', 'LEFT JOIN')
            ->where(['ev_berkas_aktif.id_user' => $id])
            // ->join('km_sub_bidang', 'id', 'left')
            ->make(true);
    }
    public function getBerkasData()
    {
        $id = session()->get('id');
        $model = new MBerkasAktif();
        // Total records
        $recordsTotal = $model->countAll();

        $data = $model->getBerkasWithItemCount($id);
        $recordsFiltered = count($data);

        return $this->response->setJSON([
            'draw' => intval($this->request->getVar('draw')), // DataTables draw counter
            'recordsTotal' => $recordsTotal, // Jumlah total records di database
            'recordsFiltered' => $recordsFiltered, // Jumlah records setelah filtering
            'data' => $data // Data yang akan ditampilkan
        ]);
    }
    public function index()
    {
        $MSubBidang     = new MSubBidang();
        $id = session()->get('id'); // Ganti 'user_id' dengan session key yang And
        $data = [
            'judul'         => 'Arsip',
            'subjudul'      => 'Berkas',
            'berkasID'      => $this->MBerkasAktif->getDataByUserId($id),
            'sub_bidang'    => $MSubBidang->getID($id),
            'data_user'     => $this->MUser->dataUser($id),
            'isi'           => 'berkas/index',
        ];
        // Kirim data ke view untuk ditampilkan
        // return view('berkas/index2', $data);
        return view('layout/wrapper', $data);
    }
    public function tambah()
    {
        // $MUser          = new MUser();
        // $MSubBidang     = new MSubBidang();
        $id = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan
        $data = [
            'judul'         => 'Berkas',
            'subjudul'      => 'Tambah Berkas',
            'isi'           => 'berkas/tambah',
            'getIdSub'      => $this->MSubBidang->getID($id),
            'data_user'     => $this->MUser->dataUser($id),
            'klasifikasi'   => $this->MKlasifikasi->allData(),
            'es2'           => $this->MKmes2->getDataByUserId($id),

        ];
        return view('layout/wrapper', $data);
    }
    public function store()
    {
        $id = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan
        $data = [
            'id_user'           => $id,
            'id_es2'            => $this->request->getPost('id_es2'),
            'id_sub_bidang'     => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'    => $this->request->getPost('id_klasifikasi'),
            'no_berkas'         => $this->request->getPost('no_berkas'),
            'nama_berkas'       => $this->request->getPost('nama_berkas'),
            'tahun_berkas'      => $this->request->getPost('tahun_berkas'),
        ];
        $this->MBerkasAktif->insert($data);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan!');
        return redirect()->to(base_url('berkas'));
    }
    public function edit($id)
    {
        $id_user = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan
        $data = [
            'judul'         => 'Arsip',
            'subjudul'      => 'Berkas',
            'isi'           => 'berkas/edit',
            'getIdSub'      => $this->MSubBidang->getID($id),
            'getId'         => $this->MBerkasAktif->getIdData($id),
            'klasifikasi'   => $this->MKlasifikasi->allData(),
            'data_user'     => $this->MUser->dataUser($id_user),
        ];
        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        $id_user = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan
        $data = [
            'id'                => $id,
            'id_user'           => $id_user,
            'id_es2'            => $this->request->getPost('id_es2'),
            'id_sub_bidang'     => $this->request->getPost('id_sub_bidang'),
            'id_klasifikasi'    => $this->request->getPost('id_klasifikasi'),
            'no_berkas'         => $this->request->getPost('no_berkas'),
            'nama_berkas'       => $this->request->getPost('nama_berkas'),
            'tahun_berkas'      => $this->request->getPost('tahun_berkas'),
        ];
        $this->MBerkasAktif->update($id, $data);
        // print_r($data);

        session()->setFlashdata('pesan', 'Data Berhasil diupdate!');
        return redirect()->to(base_url('berkas'));
    }
    public function delete($id)
    {
        // Cari data berdasarkan ID dan hapus jika ada
        if ($this->MBerkasAktif->find($id)) {
            $this->MBerkasAktif->delete($id);
            return redirect()->to(base_url('berkas'))->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to(base_url('berkas'))->with('error', 'Data tidak ditemukan.');
        }
    }
    public function tambah_item($id)
    {
        $id_user = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan

        $data = [
            'judul'         => 'Berkas',
            'subjudul'      => 'Tambah Item Berkas',
            'isi'           => 'berkas/tambah_item',
            'idBerkas'      => $this->MBerkasAktif->find($id),
            'dataBerkas'    => $this->MBerkasAktif->getData($id),
            'data_user'     => $this->MUser->dataUser($id_user),
            'arsipId'       => $this->MArsip->getIdUser($id_user),
            'idBerkasNull'  => $this->MArsip->join('km_sub_bidang', 'ev_item_aktif.id_sub_bidang=km_sub_bidang.id', 'left')->where('id_berkas IS NULL AND id_user =' . $id_user)->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function list_item($id)
    {
        $id_user = session()->get('id'); // Ganti 'user_id' dengan session key yang Anda gunakan

        $data = [
            'judul'         => 'Berkas',
            'subjudul'      => 'Tambah Item Berkas',
            'isi'           => 'berkas/list_item',
            'idBerkas'      => $this->MBerkasAktif->join('km_klasifikasi', 'ev_berkas_aktif.id_klasifikasi=km_klasifikasi.id', 'left')
                ->join('km_sub_bidang', 'ev_berkas_aktif.id_sub_bidang=km_sub_bidang.id', 'left')
                ->find($id),
            'data_user'     => $this->MUser->dataUser($id_user),
            'arsipId'       => $this->MArsip->getIdUser($id_user),
            'dataBerkas'    => $this->MArsip->where('id_berkas', $id)->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function deleteItem($id)
    {
        $model = new MArsip();
        $id_null = NULL;
        // Dapatkan id_berkas yang ingin diperbarui dari permintaan POST
        $model->set('id_berkas', $id_null)
            ->where('id', $id)
            ->update();
        // Perbarui id_berkas

        return redirect()->to('berkas'); // Ganti dengan route yang sesuai setelah update

    }
    public function importBerkas()
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
                    // nama kolom => bari excel
                    'id_user'           => $row[0] ?? null,
                    'id_es2'            => $row[0] ?? null,
                    'id_sub_bidang'     => $row[1] ?? null,
                    'int_no_berkas'     => $row[2] ?? null,
                    'id_klasifikasi'    => $row[3] ?? null,
                    'no_berkas'         => $row[4] ?? null,
                    'nama_berkas'       => $row[5] ?? null,
                    'tahun_berkas'      => $row[6] ?? null,
                    'lokasi_simpan'     => $row[7] ?? null,
                    'media_simpan'      => $row[8] ?? null,
                    'no_box'            => $row[9] ?? null,
                    'no_label'          => $row[10] ?? null,
                    'status_berkas'     => $row[11] ?? null,
                    'jenis_berkas'      => $row[12] ?? null,
                    'created_at'        => date('Y-m-d H:i:s')
                ];
            }

            if (!empty($data)) {
                // Simpan ke database
                $this->MBerkasAktif->insertBatch($data);
                return redirect()->to(base_url('Berkas'))->with('success', 'Data berhasil diimpor.');
            } else {
                return redirect()->to(base_url('Berkas'))->with('error', 'Tidak ada data yang valid untuk diimpor.');
            }
        } else {
            return redirect()->to(base_url('Berkas'))->with('error', 'File tidak valid.');
        }
    }
}

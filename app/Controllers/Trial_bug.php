<?php

namespace App\Controllers;

use App\Models\MBerkasAktif;
use App\Models\MBerkasInaktif;
use App\Models\MArsip;
use App\Models\MArsipInaktif;
use App\Models\MUser;

class Trial_bug extends BaseController
{
    protected $MBerkasAktif;
    protected $MArsip;
    protected $MUser;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->MBerkasAktif = new MBerkasAktif();
        $this->MBerkasInaktif = new MBerkasInaktif();
        $this->MArsip = new MArsip();
        $this->MArsipInaktif = new MArsipInaktif();
        $this->MUser = new MUser();
    }
    public function index($id)
    {
        $id_user = session()->get('id');
        $data = [
            'judul'         => 'Berkas',
            'subjudul'      => 'Item Berkas',
            'isi'           => 'berkas/index2',
            'idBerkas'      => $this->MBerkasAktif->find($id),
            'data_user'     => $this->MUser->dataUser($id_user),
            'berkas'        => $this->MBerkasAktif->where('id_user =' . $id_user)->findAll(),
            'itemBerkas'    => $this->MArsip->where('id_berkas IS NULL AND id_user =' . $id_user)->findAll(),
            'success'       => session()->getFlashdata('success'),
            'error'         => session()->getFlashdata('error')
        ];

        return view('layout/wrapper', $data);
    }
    public function inaktif($id)
    {
        $id_user = session()->get('id');
        $data = [
            'judul'         => 'Berkas Inaktif',
            'subjudul'      => 'Item Berkas Inaktif',
            'isi'           => 'berkasinaktif/index2',
            'idBerkas'      => $this->MBerkasInaktif->find($id),
            'data_user'     => $this->MUser->dataUser($id_user),
            'berkas'        => $this->MBerkasInaktif->where('id_user =' . $id_user)->findAll(),
            'itemBerkas'    => $this->MArsipInaktif->where('id_berkas IS NULL AND jenis_arsip="reguler" AND id_user =' . $id_user)->findAll(),
            'success'       => session()->getFlashdata('success'),
            'error'         => session()->getFlashdata('error')
        ];

        return view('layout/wrapper', $data);
    }

    public function updateItems()
    {
        $itemBerkasModel = new MArsip();
        $selectedItems = $this->request->getPost('selected_items');
        $newIdBerkas = $this->request->getPost('new_id_berkas');

        if ($selectedItems && $newIdBerkas) {
            foreach ($selectedItems as $itemId) {
                $itemBerkasModel->update($itemId, ['id_berkas' => $newIdBerkas]);
            }
            session()->setFlashdata('success', 'Item Berkas berhasil ditambah!');
        } else {
            session()->setFlashdata('error', 'Pilih item dan ID Berkas baru.');
        }

        return redirect()->to('berkas');
    }
    public function updateItemsInaktif()
    {
        $itemBerkasModel = new MArsip();
        $selectedItems = $this->request->getPost('selected_items');
        $newIdBerkas = $this->request->getPost('new_id_berkas');

        if ($selectedItems && $newIdBerkas) {
            foreach ($selectedItems as $itemId) {
                $itemBerkasModel->update($itemId, ['id_berkas' => $newIdBerkas]);
            }
            session()->setFlashdata('success', 'ID Berkas berhasil diubah!');
        } else {
            session()->setFlashdata('error', 'Pilih item dan ID Berkas baru.');
        }

        return redirect()->to('berkas');
    }
}

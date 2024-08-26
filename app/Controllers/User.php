<?php

namespace App\Controllers;

use Irsyadulibad\DataTables\DataTables;
use App\Models\MUser;
use App\Models\MKmes2;
use App\Models\MRbac;
use PHPExcel;
use PHPExcel_IOFactory;

class User extends BaseController
{
    protected $MKmes2;
    protected $MRbac;
    protected $MUser;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->MKmes2   = new MKmes2();
        $this->MRbac    = new MRbac();
        $this->MUser    = new MUser();
    }
    public function json()
    {
        $id = session()->get('id');
        return DataTables::use('users')
            ->where(['id' => $id])
            ->addColumn('action', function ($data) {
                return '<a href="/edit/' . $data->id . '">edit</a>';
            })
            ->make(true);
    }

    public function index()
    {
        $id = session()->get('id');
        $MUser = new MUser();
        $data = [
            'judul'         => 'User',
            'subjudul'      => 'Data User',
            'isi'           => 'user/index',
            'user'          => $MUser->findAll(),
            'data_user'     => $MUser->dataUser($id),
            'dtUserId'      => $MUser->dataUser($id)
        ];
        return view('layout/wrapper', $data);
    }
    public function add()
    {
        return view('user-list');
    }
    public function edit($id)
    {
        //model initialize
        $MUser = new MUser();

        $data = array(
            'judul'         => 'User',
            'subjudul'      => 'Edit User',
            'isi'           => 'user/edit',
            'data_user'     => $MUser->dataUser($id),
            'dataId'        => $MUser->find($id)
        );

        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        $userModel = new MUser();

        // Ambil data dari request
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Data yang akan diupdate
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ];

        // Update data
        $userModel->update($id, $data);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('user')->with('success', 'User updated successfully.');
    }

  
    public function getData()
    {
        $model = new MUser();
        $data = $model->findAll();

        $result = array();
        foreach ($data as $user) {
            $result[] = array(
                $user['id'],
                $user['name'],
                $user['email'],
                '<a href="' . base_url('user/edit/' . $user['id']) . '" class="btn btn-primary">Edit</a>'
            );
        }

        echo json_encode(array('data' => $result));
    }
    public function getUserById()
    {
        $session = session();
        $userId = $session->get('id'); // Pastikan 'user_id' adalah nama kunci sesi Anda

        $model = new MUser();
        $data = $model->find($userId);

        if ($data) {
            $result = array(
                array(
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'action' => '<a href="' . base_url('user/edit/' . $data['id']) . '" class="btn btn-primary">Edit</a>'
                )
            );
        } else {
            $result = array();
        }

        echo json_encode(array('data' => $result));
    }
    public function rbac()
    {
        helper(['form']);
        $id = session()->get('id');
        $MUser = new MUser();
        $MRbac = new MRbac();
        $data = [
            'judul'         => 'Menu RBAC',
            'subjudul'      => 'Setting Akses User',
            'isi'           => 'user/rbac',
            'data_user'     => $MUser->dataUser($id),
            'user'          => $MUser->findAll(),
            'dd_hak_unit'   => $MRbac->allData(),
            'es2'           => $this->MKmes2->findAll(),
        ];
        return view('layout/wrapper', $data);
    }
    public function add_user()
    {

        $data = [
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'aktif'         => '1',
            'created_at'    => date('Y-m-d H:i:s')
        ];
        // print_r($data);
        $this->MUser->insert($data);

        session()->setFlashdata('success', 'User created successfully.');
        return redirect()->to(base_url('user/rbac'));
    }
    public function add_rbac()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'      => 'required|alpha_numeric_space|min_length[3]',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[6]'
        ]);
        $data = [
            'id_user'           => $this->request->getPost('id_user'),
            'nama_grup'         => $this->request->getPost('nama_grup'),
            'key_unit'          => $this->request->getPost('key_unit'),
            'level_unit'        => $this->request->getPost('level_unit'),
            'parameter_unit'    => $this->request->getPost('parameter_unit'),
            'created_at'        => date('Y-m-d H:i:s')
        ];
        // print_r($data);
        $this->MRbac->insert($data);

        session()->setFlashdata('success', 'User created successfully.');
        return redirect()->to(base_url('user/rbac'));
    }
    public function edit_rbac($id)
    {
        $validation = \Config\Services::validation();
        $id_user = session()->get('id');
        $validation->setRules([
            'name'      => 'required|alpha_numeric_space|min_length[3]',
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[6]'
        ]);
        $data = [
            'id'                => $id,
            'id_user'           => $id_user,
            'nama_grup'         => $this->request->getPost('nama_grup'),
            'key_unit'          => $this->request->getPost('key_unit'),
            'level_unit'        => $this->request->getPost('level_unit'),
            'parameter_unit'    => $this->request->getPost('parameter_unit'),
            'created_at'        => date('Y-m-d H:i:s')
        ];
        // print_r($data);
        $this->MRbac->update($id, $data);

        session()->setFlashdata('success', 'Rbac created successfully.');
        return redirect()->to(base_url('user/rbac'));
    }
}

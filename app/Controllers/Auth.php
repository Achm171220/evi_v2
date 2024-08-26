<?php

namespace App\Controllers;

use App\Models\MUser;
use App\Models\MUserupdate;

use CodeIgniter\Controller;

class Auth extends Controller
{
    protected $MUser;
    public function __construct()
    {
        helper('form', 'url', 'download');
        $this->MUser     = new MUser();
        // $this->Spreadsheet      = new Spreadsheet();
    }
    public function index()
    {
        helper(['form']);
        echo view('auth/login');
    }
    public function loginAuth()
    {
        $session = session();
        $MUser = new MUser();
        //jika valid
        $email              = $this->request->getPost('email');
        $password           = $this->request->getPost('password');

        $data = $MUser->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify = password_verify($password, $pass);
            if ($verify) {
                # code...
                $session_data = [
                    'id'            => $data['id'],
                    'name'          => $data['name'],
                    'email'         => $data['email'],
                    'logged_in'     => true,
                ];
                $session->set($session_data);
                if ($data['id'] != 1) {
                    # code...
                    return redirect()->to('/dashboard');
                } elseif ($data['id'] == 1) {
                    return redirect()->to('/dashboard/admin');
                }
            } else {
                $session->setFlashdata('msg', 'Salah Password');
                return redirect()->to('/auth');
            }
            # code...
        } else {
            $session->setFlashdata('msg', 'Akun tidak ditemukan');
            return redirect()->to('/auth');
        }
    }
    public function updatePassword()
    {
        echo view('auth/updatepassword');
    }
    public function prosesupdatePassword()
    {
        $userModel = new MUser();
        $updatePasswordModel = new MUserupdate();

        // Ambil data dari form
        $email = $this->request->getPost('email');
        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password_baru');
        $ip_address = $this->request->getIPAddress();
        $perangkat = $this->request->getUserAgent()->getPlatform(); // Mengambil platform/perangkat pengguna
        $lokasi = $this->request->getPost('lokasi'); // Ambil lokasi

        if (empty($lokasi)) {
            $lokasi = 'Lokasi tidak tersedia'; // Default value jika lokasi tidak didapatkan
        }
        // Validasi input
        if (empty($email) || empty($password_lama) || empty($password_baru)) {
            return redirect()->to('auth/updatepassword')->with('error', 'Semua field harus diisi.');
        }

        // Cek apakah email ada
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('auth/updatepassword')->with('error', 'Email tidak ditemukan.');
        }

        // Cek apakah password lama sesuai
        if (!password_verify($password_lama, $user['password'])) {
            return redirect()->to('auth/updatepassword')->with('error', 'Password lama tidak sesuai.');
        }

        // Lakukan update password di tabel_user
        $userModel->update($user['id'], ['password' => password_hash($password_baru, PASSWORD_DEFAULT)]);

        // Simpan riwayat update password di tabel_update_password
        $updatePasswordModel->insert([
            'id_user'       => $user['id'],
            'old_password'  => password_hash($password_lama, PASSWORD_DEFAULT), // Simpan password lama yang sudah di-hash
            'new_password'  => password_hash($password_baru, PASSWORD_DEFAULT), // Simpan password baru yang sudah di-hash
            'ip_address'    => $ip_address,
            'perangkat'     => $perangkat,
            'lokasi'        => $lokasi // Simpan lokasi
        ]);

        return redirect()->to('auth/updatepassword')->with('success', 'Password berhasil diperbarui, silakan kembali :)');
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('auth');
    }
}

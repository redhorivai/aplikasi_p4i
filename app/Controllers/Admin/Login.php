<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $usermodel;
    protected $session;
    public function __construct()
    {
        $this->usermodel = new UserModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Area',
        ];
        echo view('admin/v_login', $data);
    }

    public function cek_login()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getPost('username');
            $password = sha1(md5($this->request->getPost('password')));
            $status_acc = 'active';
            $cek_user = $this->usermodel->cekUser($username);
            if ($cek_user['status_acc'] == 'deactive') {
                $msg = ['gagal' => "Login Gagal.. Akun Anda tidak aktif"];
            } else if ($cek_user['username'] != $username) {
                $msg = ['gagal' => "Login Gagal.. Username tidak ditemukan"];
            } else {
                $cek = $this->usermodel->loginCheck($username, $password, $status_acc);
                if ($cek['username'] == $username && $cek['password'] == $password && $cek['status_acc'] == $status_acc) {
                    session()->set('user_id', $cek['user_id']);
                    session()->set('name', $cek['name']);
                    session()->set('username', $cek['username']);
                    session()->set('level', $cek['level']);
                    session()->set('gender', $cek['gender']);
                    session()->set('avatar', $cek['avatar']);
                    $msg = ['sukses' => 'Selamat Datang.. ' . session()->get('name') . '',];
                } else {
                    $msg = ['gagal' => "Login Gagal.. Silahkan hubungi administrator"];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function logout()
    {
        session()->setTempdata('user_id');
        session()->setTempdata('name');
        session()->setTempdata('username');
        session()->setTempdata('level');
        session()->setTempdata('gender');
        session()->setTempdata('avatar');
        session()->setFlashdata('sukses', 'Anda telah logout ..');
        return redirect()->to(base_url('Admin/'));
    }
    //--------------------------------------------------------------------

}

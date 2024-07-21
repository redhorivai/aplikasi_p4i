<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\DaftarModel;

class Daftar extends BaseController
{
    protected $m_daftar;
    protected $session;
    public function __construct()
    {
        $this->m_daftar = new DaftarModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Area',
        ];
        return view('admin/daftar', $data);
    }

    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $name     = $this->request->getPost('name');
            $username = strtolower($this->request->getPost('username'));
            $no_id   = $this->request->getPost('no_id');
            $gender   = $this->request->getPost('gender');
            $email   = $this->request->getPost('email');
            $phone   = $this->request->getPost('phone');
            $tempat_lahir    = $this->request->getPost('tempat_lahir');
            $tanggal_lahir  = $this->request->getPost('tanggal_lahir');
            $level    = $this->request->getPost('level');
            $address  = $this->request->getPost('address');
            $data = [
                'name'         => $name,
                'username'     => $username,
                'no_id'        => $no_id,
                'gender'       => $gender,
                'email'         => $email,
                'phone'     => $phone,
                'tempat_lahir'        => $tempat_lahir,
                'tanggal_lahir'       => $tanggal_lahir,
                'level'        => $level,
                'address'      => $address,
                'password'     => sha1(md5('123456')),
                'status_cd'    => 'normal',
                'created_user' => NULL,
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_daftar->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "NIM/NIDN: <b class='text-danger'>$no_id</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
}
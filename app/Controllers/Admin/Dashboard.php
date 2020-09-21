<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }
        $data = [
            'title' => 'Dashboard'
        ];
        return view('/admin/dashboard', $data);
    }
    //--------------------------------------------------------------------

}

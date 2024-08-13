<?php

namespace App\Controllers;
use App\Models\Backend\InfoModel;
use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;

class Layanansaran extends BaseController
{
    protected $m_info;
    protected $m_layanan;
    protected $m_artikel;
    protected $m_instansi;
    protected $session;
    public function __construct()
    {
        $this->m_info     = new InfoModel();
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'Layanan Pertanyaan',
            'menu'          => 'saran',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/layanan-saran', $data);
    }
    public function layanan_saran()
    {
        $data = [
            'title'         => 'Layanan Saran',
            'menu'          => 'saran',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/layanan-saran', $data);
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $nama    = strtoupper($this->request->getPost('nama'));
            $email   = strtolower($this->request->getPost('email'));
            $telepon = $this->request->getPost('telepon');
            $pesan   = $this->request->getPost('pesan');
            $data = [
                'nama'       => $nama,
                'email'      => $email,
                'telepon'    => $telepon,
                'pesan'      => $pesan,
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            print_r($data);
            $insert = $this->m_layanan->Insertsaran($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Terjadi kesalahan, silahkan coba beberapa saat lagi.";
            }
        } 
        else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
}

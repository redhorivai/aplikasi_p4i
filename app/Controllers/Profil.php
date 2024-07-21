<?php

namespace App\Controllers;

use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;

class Profil extends BaseController
{
    protected $m_artikel;
    protected $m_instansi;
    protected $m_chart;
    protected $session;
    public function __construct()
    {
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'Tentang Kami',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/tentang-kami', $data);
    }
    public function tentangkami()
    {
        $data = [
            'title'         => 'Tentang Kami',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/tentang-kami', $data);
    }
    public function visimisi()
    {
        $data = [
            'title'         => 'Visi dan Misi',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/visi-misi', $data);
    }
}

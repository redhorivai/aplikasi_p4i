<?php

namespace App\Controllers;

// use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\BeritaModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;


class Home extends BaseController
{
    // protected $m_layanan;
    protected $m_artikel;
    protected $m_berita;
    protected $m_instansi;
    protected $m_pengguna;
    protected $session;
    public function __construct()
    {
        // $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_berita  = new BeritaModel();
        $this->m_instansi = new InstansiModel();
        $this->m_pengguna = new PenggunaModel();
        $this->date       = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        
        // ARTIKEL
        $artikel = $this->m_berita->getBerita();
        $resArtikel = "";
        if (count($artikel) > 0) {
            foreach ($artikel as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if($level == "Super User"){
                        $nama = "Admin";
                    } else {
                        $nama = "Humas RSUD Palembang BARI";
                    }
                }
                $jmlStrTitle = strlen($res->title);
                if ($jmlStrTitle >= 21) {
                    $titleStr = substr($res->title, 0, 21);
                    $title = $titleStr . '...';
                } else {
                    $title = $res->title;
                }
                $jmlStrDesc = strlen($res->description);
                if ($jmlStrDesc >= 88) {
                    $descStr = substr($res->description, 0, 88);
                    $description = $descStr . '...';
                } else {
                    $description = $res->description;
                }
                $tgl = date('d', strtotime($res->created_dttm));
                $bln = date('M', strtotime($res->created_dttm));
                $resArtikel .= "<div class='item'>
                                    <article class='post clearfix bg-lighter'>
                                    <div class='entry-header'>
                                        <div class='post-thumb thumb'>
                                        <img src='".base_url()."/image/artikel/".$res->thumbnail_nm."' class='img-responsive img-fullwidth'>
                                        </div>
                                        <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                                        <ul>
                                            <li class='font-16 text-white font-weight-600'>".$tgl."</li>
                                            <li class='font-12 text-white text-uppercase'>".$bln."</li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class='entry-content p-15 pt-10 pb-10'>
                                        <div class='entry-meta media no-bg no-border mt-0 mb-10'>
                                        <div class='media-body pl-0'>
                                            <div class='event-content pull-left flip'>
                                            <h4 class='entry-title text-white text-uppercase font-weight-600 m-0 mt-5'><a href='".base_url('/informasi/detail_artikel/'.$res->artikel_id.'')."'>".$title."</a></h4>
                                            <ul class='list-inline entry-date font-12 mt-5'>
                                            <li class='pr-0'>
                                            <small class='text-theme-colored' href='javascript:void(0)'>".$nama." | " . $this->date->panjang($res->created_dttm) . "</small>
                                            </li>
                                            </ul>
                                            </div>
                                        </div>
                                        </div>
                                        <p class='mt-5'>".$description."</p>
                                        <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    </div>
                                    </article>
                                    </div>";
            }
        }
        
        $data = [
            'title'              => 'Beranda',
            'menu'               => 'home',
            'resLayananUnggulan' => $resLayananUnggulan,
            'resArtikel'         => $resArtikel,
            'artikelFooter'      => $this->m_berita->getLimit('3'),
            'dataInstansi'       => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/beranda', $data);
    }
}

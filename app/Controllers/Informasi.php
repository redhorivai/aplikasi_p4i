<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Backend\InfoModel;
use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\PenggunaModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\EbookModel;
use App\Libraries\Date\DateFunction;
use App\Models\Backend\BeritaModel;
use App\Models\Backend\EdukasiModel;

class Informasi extends BaseController
{
    protected $m_info;
    protected $m_layanan;
    protected $m_artikel;
    protected $m_berita;
    protected $m_edukasi;
    protected $m_pengguna;
    protected $m_instansi;
    protected $m_ebook;
    protected $session;
    public function __construct()
    {
        $this->m_info  = new InfoModel();
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_berita   = new BeritaModel();
        $this->m_edukasi  = new EdukasiModel();
        $this->m_pengguna = new PenggunaModel();
        $this->m_instansi = new InstansiModel();
        $this->m_ebook    = new EbookModel();
        $this->date       = new DateFunction();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function berita()
    {
        $artikel = $this->m_berita->getBerita();
        $resContent = "";
        if (count($artikel)) {
            foreach ($artikel as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if ($level == "Super User") {
                        $nama = "Admin";
                    } else {
                        $nama = "Humas P4I";
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
                if ($res->type == 'berita') {
                    $resContent .= "<div class='col-sm-6 col-md-3 col-lg-3'>
                                    <article class='post clearfix maxwidth600 mb-30'>
                                    <div class='entry-header'>
                                    <div class='post-thumb thumb'> 
                                    <img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'> 
                                    </div>
                                    </div>
                                    <div class='entry-content border-1px p-20'>
                                    <h5 class='entry-title mt-0 pt-0'>
                                    <a href='" . base_url('/informasi/detail_berita/' . $res->artikel_id . '') . "'>
                                    " . $title . "
                                    </a>
                                    </h5>
                                    <ul class='list-inline entry-date font-12 mt-5'>
                                    <li class='pr-0'>
                                    <small class='text-theme-colored' href='javascript:void(0)'>" . $nama . " | " . $this->date->panjang($res->created_dttm) . " | " . $res->kategori . "</small>
                                    </li>
                                    </ul>
                                    <p class='text-left mb-20 mt-15 font-13'>" . $description . "</p>
                                    <a href='" . base_url('/informasi/detail_berita/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    <div class='clearfix'></div>
                                    </div>
                                    </article>
                                    </div>";
                }
            }
        } else {
            $resContent .= "<h5 class='text-center' style='padding-bottom:30px;'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Berita',
            'menu'          => 'informasi',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_berita->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/berita', $data);
        // print_r(json_encode($artikel));
    }
    public function detail_berita($id)
    {
        $detail = $this->m_berita->getByID($id);
        $resDetail = "";
        foreach ($detail as $res) {
            $user = $this->m_pengguna->getByID($res->created_user);
            foreach ($user as $data) {
                $level = $data->level;
                if ($level == "Super User") {
                    $nama = "Admin";
                } else {
                    $nama = "Humas P4I";
                }
            }
            if (!empty($res->thumbnail_nm)) {
                $banner = "<img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'>";
            } else {
                $banner = "<img src='" . base_url() . "/image/thumbnail/800x600.png' class='img-responsive img-fullwidth'>";
            }

            $tgl = date('d', strtotime($res->created_dttm));
            $bln = date('M', strtotime($res->created_dttm));
            $g = array("", $res->banner_nm, $res->banner_nm2, $res->banner_nm3, $res->banner_nm4, $res->banner_nm5, $res->banner_nm6);

            $resDetail .= "
            <div class='col-md-9'>
                <div class='blog-posts single-post'>
                    <article class='post clearfix mb-0' style='border-bottom:none !important;'>
                        <div class='entry-header'>
                        <div class='post-thumb thumb'>";
            for ($i = 1; $i <= 6; $i++) {
                if ($g[$i] != "800x600.png") {
                    $resDetail .= "<div class='mySlides'>
                                           <div class='numbertext'>" . $i . " / 6</div>
                                           <img src='" . base_url() . "/image/artikel/" . $g[$i] . "' style='width:100%'>
                                           </div>";
                }
            }
            $resDetail .= "
                      <a class='prev' onclick='plusSlides(-1)'>❮</a>
                      <a class='next' onclick='plusSlides(1)'>❯</a>
                    
                      <div class='caption-container'>
                        <p style='margin-bottom:0 !important;padding-top:5px;padding-bottom:5px;' id='caption'></p>
                      </div>";

            for ($i = 1; $i <= 6; $i++) {
                if ($g[$i] != "800x600.png") {
                    $resDetail .= "<div class='column'>
                                       <img class='demo cursor' src='" . base_url() . "/image/artikel/" . $g[$i] . "' style='width:100%;' onclick='currentSlide(" . $i . ")' alt='Perkumpulan Pemberantasan Penyakit Parasitik Indonesia'>
                                       </div>";
                }
            }
            $resDetail .= "            
                        </div>
                        </div>
                        <div class='entry-content'>
                        <div class='entry-meta media no-bg no-border mt-15 pb-20'>
                            <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                            <ul>
                                <li class='font-16 text-white font-weight-600'>" . $tgl . "</li>
                                <li class='font-12 text-white text-uppercase'>" . $bln . "</li>
                            </ul>
                            </div>
                            <div class='media-body pl-15'>
                            <div class='event-content pull-left flip'>
                                <h3 class='entry-title text-dark text-uppercase pt-0 mt-0'>
                                " . $res->title . "
                                </h3>
                                <span class='mb-10 text-gray-darkgray mr-10 font-13'>
                                <i class='fa fa-pencil mr-5 text-theme-colored'></i> 
                                Diposting oleh " . $nama . "</span>
                            </div>
                            </div>
                        </div>
                        <p class='mb-15'>" . $res->description . "</p>
                        </div>
                    </article>
                </div>
            </div>";
        }
        $data = [
            'title'         => 'Detail Berita',
            'menu'          => 'informasi',
            'resDetail'     => $resDetail,
            'latestNews'    => $this->m_berita->getLimit('8'),
            'artikelFooter' => $this->m_berita->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/detail_berita', $data);
    }
    public function artikel()
    {
        $artikel = $this->m_artikel->getArtikel();
        $resContent = "";
        if (count($artikel)) {
            foreach ($artikel as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if ($level == "Super User") {
                        $nama = "Admin";
                    } else {
                        $nama = "Humas P4I";
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
                if ($res->type == 'artikel') {
                    $resContent .= "<div class='col-sm-6 col-md-3 col-lg-3'>
                                    <article class='post clearfix maxwidth600 mb-30'>
                                    <div class='entry-header'>
                                    <div class='post-thumb thumb'> 
                                    <img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'> 
                                    </div>
                                    </div>
                                    <div class='entry-content border-1px p-20'>
                                    <h5 class='entry-title mt-0 pt-0'>
                                    <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "'>
                                    " . $title . "
                                    </a>
                                    </h5>
                                    <ul class='list-inline entry-date font-12 mt-5'>
                                    <li class='pr-0'>
                                    <small class='text-theme-colored' href='javascript:void(0)'>" . $nama . " | " . $this->date->panjang($res->created_dttm) . " | " . $res->kategori . "</small>
                                    </li>
                                    </ul>
                                    <p class='text-left mb-20 mt-15 font-13'>" . $description . "</p>
                                    <a href='" . base_url('/informasi/detail_artikel/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    <div class='clearfix'></div>
                                    </div>
                                    </article>
                                    </div>";
                }
            }
        } else {
            $resContent .= "<h5 class='text-center' style='padding-bottom:30px;'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Artikel',
            'menu'          => 'informasi',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/artikel', $data);
    }
    public function detail_artikel($id)
    {
        $detail = $this->m_artikel->getByID($id);
        $resDetail = "";
        foreach ($detail as $res) {
            $user = $this->m_pengguna->getByID($res->created_user);
            foreach ($user as $data) {
                $level = $data->level;
                if ($level == "Super User") {
                    $nama = "Admin";
                } else {
                    $nama = "Humas P4I";
                }
            }
            if (!empty($res->thumbnail_nm)) {
                $banner = "<img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'>";
            } else {
                $banner = "<img src='" . base_url() . "/image/thumbnail/800x600.png' class='img-responsive img-fullwidth'>";
            }

            $tgl = date('d', strtotime($res->created_dttm));
            $bln = date('M', strtotime($res->created_dttm));
            $g = array("", $res->banner_nm, $res->banner_nm2, $res->banner_nm3, $res->banner_nm4, $res->banner_nm5, $res->banner_nm6);

            $resDetail .= "
            <div class='col-md-9'>
                <div class='blog-posts single-post'>
                    <article class='post clearfix mb-0' style='border-bottom:none !important;'>
                        <div class='entry-header'>
                        <div class='post-thumb thumb'>";
            for ($i = 1; $i <= 6; $i++) {
                if ($g[$i] != "800x600.png") {
                    $resDetail .= "<div class='mySlides'>
                                           <div class='numbertext'>" . $i . " / 6</div>
                                           <img src='" . base_url() . "/image/artikel/" . $g[$i] . "' style='width:100%'>
                                           </div>";
                }
            }
            $resDetail .= "
                      <a class='prev' onclick='plusSlides(-1)'>❮</a>
                      <a class='next' onclick='plusSlides(1)'>❯</a>
                    
                      <div class='caption-container'>
                        <p style='margin-bottom:0 !important;padding-top:5px;padding-bottom:5px;' id='caption'></p>
                      </div>";

            for ($i = 1; $i <= 6; $i++) {
                if ($g[$i] != "800x600.png") {
                    $resDetail .= "<div class='column'>
                                       <img class='demo cursor' src='" . base_url() . "/image/artikel/" . $g[$i] . "' style='width:100%;' onclick='currentSlide(" . $i . ")' alt='Perkumpulan Pemberantasan Penyakit Parasitik Indonesia'>
                                       </div>";
                }
            }
            $resDetail .= "            
                        </div>
                        </div>
                        <div class='entry-content'>
                        <div class='entry-meta media no-bg no-border mt-15 pb-20'>
                            <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                            <ul>
                                <li class='font-16 text-white font-weight-600'>" . $tgl . "</li>
                                <li class='font-12 text-white text-uppercase'>" . $bln . "</li>
                            </ul>
                            </div>
                            <div class='media-body pl-15'>
                            <div class='event-content pull-left flip'>
                                <h3 class='entry-title text-dark text-uppercase pt-0 mt-0'>
                                " . $res->title . "
                                </h3>
                                <span class='mb-10 text-gray-darkgray mr-10 font-13'>
                                <i class='fa fa-pencil mr-5 text-theme-colored'></i> 
                                Diposting oleh " . $nama . "</span>
                            </div>
                            </div>
                        </div>
                        <p class='mb-15'>" . $res->description . "</p>
                        </div>
                    </article>
                </div>
            </div>";
        }
        $data = [
            'title'         => 'Detail Artikel',
            'menu'          => 'informasi',
            'resDetail'     => $resDetail,
            'latestNews'    => $this->m_artikel->getLimit('8'),
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/detail_artikel', $data);
    }
    public function edukasi()
    {
        $artikel = $this->m_edukasi->getEdukasi();
        $resContent = "";
        if (count($artikel)) {
            foreach ($artikel as $res) {
                $user = $this->m_pengguna->getByID($res->created_user);
                foreach ($user as $data) {
                    $level = $data->level;
                    if ($level == "Super User") {
                        $nama = "Admin";
                    } else {
                        $nama = "Humas P4I";
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
                if ($res->type == 'edukasi') {
                    $resContent .= "<div class='col-sm-6 col-md-3 col-lg-3'>
                                    <article class='post clearfix maxwidth600 mb-30'>
                                    <div class='entry-header'>
                                    <div class='post-thumb thumb'> 
                                    <img src='" . base_url() . "/assets-admin/panel/images/youtube.png' class='img-responsive' style='width:100px;'> 
                                    </div>
                                    </div>
                                    <div class='entry-content border-1px p-20'>
                                    <h5 class='entry-title mt-0 pt-0'>
                                    <a href='" . base_url('/informasi/detail_edukasi/' . $res->artikel_id . '') . "'>
                                    " . $title . "
                                    </a>
                                    </h5>
                                    <ul class='list-inline entry-date font-12 mt-5'>
                                    <li class='pr-0'>
                                    <small class='text-theme-colored' href='javascript:void(0)'>" . $nama . " | " . $this->date->panjang($res->created_dttm) . "</small>
                                    </li>
                                    </ul>
                                    <p class='text-left mb-20 mt-15 font-13'>" . $description . "</p>
                                    <a href='" . base_url('/informasi/detail_edukasi/' . $res->artikel_id . '') . "' class='btn btn-dark btn-theme-colored btn-xs btn-flat mt-0'>Selengkapnya</a>
                                    <div class='clearfix'></div>
                                    </div>
                                    </article>
                                    </div>";
                }
            }
        } else {
            $resContent .= "<h5 class='text-center' style='padding-bottom:30px;'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Edukasi',
            'menu'          => 'informasi',
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_edukasi->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/edukasi', $data);
    }
    public function detail_edukasi($id)
    {
        $detail = $this->m_edukasi->getByID($id);
        // print_r(json_encode($detail));
        // var_dump($detail);
        $resDetail = "";
        foreach ($detail as $res) {
            $user = $this->m_pengguna->getByID($res->created_user);
            foreach ($user as $data) {
                $level = $data->level;
                if ($level == "Super User") {
                    $nama = "Admin";
                } else {
                    $nama = "Humas P4I";
                }
            }
            if (!empty($res->thumbnail_nm)) {
                $banner = "<img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'>";
            } else {
                $banner = "<img src='" . base_url() . "/image/thumbnail/800x600.png' class='img-responsive img-fullwidth'>";
            }

            $tgl = date('d', strtotime($res->created_dttm));
            $bln = date('M', strtotime($res->created_dttm));
            $g = array("", $res->banner_nm, $res->banner_nm2, $res->banner_nm3, $res->banner_nm4, $res->banner_nm5, $res->banner_nm6);

            $resDetail .= "
            <div class='col-md-9'>
                <div class='blog-posts single-post'>
                    <article class='post clearfix mb-0' style='border-bottom:none !important;'>
                        <div class='entry-header'>
                        <div class='post-thumb thumb'>";
                    $resDetail .= "<div class='mySlides'>
                                           <div></div>
                                           <embed src='$res->path_edukasi' width='720px' height='330px' allowfullscreen />
                                           </div>";
            
            // print_r($detail->path_edukasi);
            $resDetail .= "
                      <div class='caption-container'>
                        <p style='margin-bottom:0 !important;padding-top:5px;padding-bottom:5px;' id='caption'></p>
                      </div>";
            
            $resDetail .= "            
                        </div>
                        </div>
                        <div class='entry-content'>
                        <div class='entry-meta media no-bg no-border mt-15 pb-20'>
                            <div class='entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15'>
                            <ul>
                                <li class='font-16 text-white font-weight-600'>" . $tgl . "</li>
                                <li class='font-12 text-white text-uppercase'>" . $bln . "</li>
                            </ul>
                            </div>
                            <div class='media-body pl-15'>
                            <div class='event-content pull-left flip'>
                                <h3 class='entry-title text-dark text-uppercase pt-0 mt-0'>
                                " . $res->title . "
                                </h3>
                                <span class='mb-10 text-gray-darkgray mr-10 font-13'>
                                <i class='fa fa-pencil mr-5 text-theme-colored'></i> 
                                Diposting oleh " . $nama . "</span>
                            </div>
                            </div>
                        </div>
                        <p class='mb-15'>" . $res->description . "</p>
                        </div>
                    </article>
                </div>
            </div>";
        }
        $data = [
            'title'         => 'Detail Edukasi',
            'menu'          => 'informasi',
            'resDetail'     => $resDetail,
            'latestNews'    => $this->m_edukasi->getLimit('8'),
            'artikelFooter' => $this->m_edukasi->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/detail_edukasi', $data);
    }
    public function ebook()
    {
        $alur       = $this->m_ebook->getEbook();
        $resTitle   = "";
        $resContent = "";
        if (count($alur) > 0) {
            $resTitle .= "<div class='col-md-3 scrolltofixed-container'><div class='list-group scrolltofixed z-index-0 mt-40'>";
            $resContent .= "<div class='col-md-9'>";
            foreach ($alur as $res) {
                // $resContent .= "<div id='".$res->id."' class='mb-50'>
                //                 <h3 class='title mt-0 mb-30 line-bottom'>E-Book</h3>";
                $resContent .= "
                                    <div id='" . $res->id . "'>
                                    <div class='icon-box mb-0' style='border: solid 1px #DDD; border-radius: 4px;'>
                                    <p class='icon-box-title pl-30 pt-15 mt-0 mb-0'><span style='color:red;-webkit-font-smoothing:auto'>klik disini -> </span><a style='color:#337ab7;text-decoration:none;-webkit-font-smoothing:auto'href=" . $res->link . " target = '_blank'>" . $res->judul . "</a></p>
                                    <div class='row'>
                                    <div class='col-md-12'>
                                    </div>
                                    </div>
                                    </div>";
                $resContent .= "</div>";
            }
            $resTitle .= "</div></div>";
            $resContent .= "</div>";
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Kumpulan Ebook',
            'menu'          => 'ebook',
            'resTitle'      => $resTitle,
            'resContent'    => $resContent,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/ebook', $data);
        // print_r($data);
    }
    public function faq()
    {
        $faq = $this->m_info->getByTypeLimit('faq', 0);
        $resAccordion = "";
        if (count($faq)){
            $resAccordion .= "<div class='col-md-8'><div id='accordion1' class='panel-group accordion'>";
            foreach ($faq as $res){
                $resAccordion .= "<div class='panel'>
                                   <div class='panel-title'> 
                                    <a data-parent='#accordion1' data-toggle='collapse' href='#".$res->info_id."' class='collapsed' aria-expanded='false'> <span class='open-sub'></span> Q. ".$res->info_title."</a> 
                                   </div>
                                   <div id='".$res->info_id."' class='panel-collapse collapse' role='tablist' aria-expanded='false' style='height: 0px;'>
                                    <div class='panel-content'>
                                     <p>".$res->info_desc."</p>
                                    </div>
                                   </div>
                                  </div>";
            }
            $resAccordion .= "</div></div>";
        } else {
            $resAccordion .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'FAQ',
            'menu'          => 'faq',
            'resAccordion'  => $resAccordion,
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/informasi/faq', $data);
    }
}

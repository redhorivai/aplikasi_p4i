<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Backend\LayananModel;
use App\Models\Backend\ArtikelModel;
use App\Models\Backend\PenggunaModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\EbookModel;
use App\Libraries\Date\DateFunction;

class Informasi extends BaseController
{
    protected $m_layanan;
    protected $m_artikel;
    protected $m_pengguna;
    protected $m_instansi;
    protected $m_ebook;
    protected $session;
    public function __construct()
    {
        $this->m_layanan  = new LayananModel();
        $this->m_artikel  = new ArtikelModel();
        $this->m_pengguna = new PenggunaModel();
        $this->m_instansi = new InstansiModel();
        $this->m_ebook    = new EbookModel();
        $this->date       = new DateFunction();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function artikel()
    {
        $alur       = $this->m_artikel->getIdArtikel();
        $resTitle   = "";
        $resContent = "";
        if (count($alur) > 0) {
            $resTitle .= "<div class='col-md-3 scrolltofixed-container'><div class='list-group scrolltofixed z-index-0 mt-40'>";
            $resContent .= "<div class='col-md-9'>";
            foreach ($alur as $res) {
                $detail = $this->m_artikel->getByTypeLimit($res->kategori, 0);
                if ($res->kategori == "bukan") {
                    $kategori = "Bukan Kategori Artikel";
                } else if ($res->kategori == "protozoa") {
                    $kategori = "Protozoa";
                } else if ($res->kategori == "helminthologi") {
                    $kategori = "Helminthologi";
                } else if ($res->kategori == "entomologi") {
                    $kategori = "Entomologi";
                } else if ($res->kategori == "zoonosis") {
                    $kategori = "Zoonosis";
                } else {
                    $kategori = "Tropis";
                }
                $resTitle .= "<a href='#" . $res->kategori . "' class='list-group-item smooth-scroll-to-target'><h5><b>" . $kategori . "</b></h5></a>";
                $resContent .= "<div id='" . $res->kategori . "' class='mb-50'>
                                <h3 class='title mt-0 mb-30 line-bottom'>" . $kategori . "</h3>";
                foreach ($detail as $res) {
                    $resContent .= "
                                    <div class='icon-box mb-0' style='border: solid 1px #DDD; border-radius: 4px;'>
                                    <article class='post clearfix maxwidth600 mb-30'>
                                    <div class='entry-header'>
                                    <div class='post-thumb thumb'> 
                                    <img src='" . base_url() . "/image/artikel/" . $res->thumbnail_nm . "' class='img-responsive img-fullwidth'> 
                                    </div>
                                    </div>
                                    <h4 class='icon-box-title pl-30 pt-15 mt-0 mb-0'>" . $res->title . "</h4>
                                    <div class='row'>
                                    <div class='col-md-12'>
                                    <p class='text-gray pl-30 pr-30'>" . $res->description . "</p>
                                    </div>
                                    </div>
                                    </div>";
                }
                $resContent .= "</div>";
            }
            $resTitle .= "</div></div>";
            $resContent .= "</div>";
        } else {
            $resContent .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'         => 'Artikel / Berita',
            'menu'          => 'artikel',
            'resTitle'      => $resTitle,
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
                    $nama = "Anggota P4i";
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
                                       <img class='demo cursor' src='" . base_url() . "/image/artikel/" . $g[$i] . "' style='width:100%;' onclick='currentSlide(" . $i . ")' alt='RSUD Palembang BARI'>
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
}

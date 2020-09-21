<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
        // SLIDER SECTION
        $slider = $this->sldr->get_slider()->getResult();
        $resSlider = "";
        if (count($slider) > 0) {
            foreach ($slider as $res) {
                if (!empty($res->title) && !empty($res->sub_title)) {
                    $overlay = "<div class='col-lg-8 has-overlay-dark' style='padding:20px;'>
                                <h1>$res->title</h1>
                                <p class='template-text'>$res->sub_title</p>
                                <a href='javascript:void(0)' class='btn btn-gradient'>Learn More</a>
                                </div>";
                } else if (!empty($res->title) && empty($res->sub_title)) {
                    $overlay = "<div class='col-lg-8 has-overlay-dark' style='padding:20px;'>
                                <h1>$res->title</h1>
                                <p class='template-text'></p>
                                <a href='javascript:void(0)' class='btn btn-gradient'>Learn More</a>
                                </div>";
                } else if (empty($res->title) && !empty($res->sub_title)) {
                    $overlay = "<div class='col-lg-8 has-overlay-dark' style='padding:20px;'>
                                <h1></h1>
                                <p class='template-text'>$res->sub_title</p>
                                <a href='javascript:void(0)' class='btn btn-gradient'>Learn More</a>
                                </div>";
                } else {
                    $overlay = '';
                }
                $resSlider .= "<div class='swiper-slide'>
                               <div style='background: url(" . base_url() . "/img/slider/$res->slider_img)'  class='hero-content'>
                               <div class='container'>
                               <div class='row' style='padding:20px;'>$overlay</div>
                               </div>
                               </div>
                               </div>";
            }
        } else {
            $resSlider .= "<div class='swiper-slide'>
                           <div style='background: url(" . base_url() . "/img/slider/slider.png)' class='hero-content'></div>
                           </div>";
        }
        // PACKAGES SECTION
        $product = $this->prod->get_product()->getResult();
        $resProduct = "";
        if (count($product) > 0) {
            foreach ($product as $res) {
                if (!empty($res->price2)) {
                    $ribbon = "<div class='ribbon-promo text-center'><strong>PROMO</strong></div>";
                    $harga = "<del>Rp " . number_format($res->price1, 0, ',', '.') . "</del> Rp " . number_format($res->price2, 0, ',', '.') . "";
                } else {
                    $ribbon = "";
                    $harga = "Rp " . number_format($res->price1, 0, ',', '.') . "";
                }
                $resProduct .= "<div class='swiper-slide'>
                                <div class='property mb-5 mb-lg-0' style='height:420px;'>
                                <div class='image'>
                                <img src='/assets/img/venue1.jpg' class='img-fluid'>
                                <div class='overlay d-flex align-items-center justify-content-center'>
                                <a href='javascript:void(0)' onclick='detailPackages($res->product_id)' class='btn btn-gradient btn-sm'>View Details</a>
                                </div>
                                </div>
                                $ribbon
                                <div class='info' style='padding:10px;'>
                                <a href='javascript:void(0)' onclick='detailPackages($res->product_id)' class='no-anchor-style' style='height:60px;'>
                                <h3 class='h4 text-primary text-thin text-uppercase' style='font-size:1rem !important;margin-bottom:0;'>$res->product_nm</h3>
                                </a>
                                <ul class='tags list-inline mb-1'>
                                <li class='list-inline-item'><a href='#' style='font-size:10px;'>$res->category_nm</a></li>
                                </ul>
                                <div class='price text-light'>$harga</div>
                                </div>
                                </div>
                                </div>";
            }
        } else {
            $resProduct .= "<h4 class='text-center text-thin w-100'>No packages posted yet.</h4>";
        }
        // PORTOFOLIO SECTION
        $portofolio = $this->port->get_portofolio()->getResult();
        $resPortofolio = "";
        if (count($portofolio) > 0) {
            foreach ($portofolio as $res) {
                $img = $this->port->getimageslim($res->portofolio_id)->getResult();
                $resPortofolio .= "<div class='col-lg-6'>
                                   <div class='listing-home'>";
                foreach ($img as $key) {
                    $resPortofolio .= "<img src='" . base_url() . "/img/portofolio/" . $key->images_nm . "'>";
                }
                $resPortofolio .= "<a href='#' class='text no-anchor-style'>
                                   <h3>$res->portofolio_nm</h3>
                                   <p>$res->category_nm</p>
                                   </a>
                                   <div class='ribbon text-center'><strong class='d-block'>30</strong><small>Agustus</small></div>
                                   </div>
                                   </div>";
            }
        } else {
            $resPortofolio .= "<h4 class='text-center text-thin w-100'>No portofolio posted yet.</h4>";
        }
        // PLANNER SECTION
        $planner = $this->user->get_user()->getResult();
        $resUser = "";
        if (count($planner) > 0) {
            foreach ($planner as $res) {
                if (empty($res->avatar) && $res->gender == 'L') {
                    $foto = "<img src='" . base_url() . "/img/user/avatar.png' class='img-fluid'>";
                } else if (empty($res->avatar) && $res->gender == 'P') {
                    $foto = "<img src='" . base_url() . "/img/user/avatar3.png' class='img-fluid'>";
                } else if (!empty($res->avatar)) {
                    $foto = "<img src='" . base_url() . "/img/user/" . $res->avatar . "' class='img-fluid'>";
                }
                $resUser .= "<div class='swiper-slide'>
                            <div class='agent mb-5 mb-lg-0'>
                            <div class='image'>$foto
                                <ul class='contact-info list-unstyled mb-0'>
                                <li><a href='mailto:$res->username'><i class='icon-envelope-1'></i>EMAIL</a></li>
                                <li><a href='#'><i class='icon-smart-phone-2'></i>TELEPON</a></li>
                                </ul>
                            </div>
                            <div class='info' style='padding:15px;'>
                                <a href='javascript:void(0)' class='no-anchor-style'>
                                <h3 class='h4 text-thin text-uppercase mb-1'>$res->name</h3>
                                </a>
                                <p class='mb-0'>JABATAN</p>
                            </div>
                            <ul class='agent-social list-inline d-flex justify-content-between align-items-center'>
                                <li class='list-inline-item'><a href='#'><i class='fa fa-twitter'></i></a></li>
                                <li class='list-inline-item'><a href='#'><i class='fa fa-facebook'></i></a></li>
                                <li class='list-inline-item'><a href='#'><i class='fa fa-linkedin'></i></a></li>
                                <li class='list-inline-item'><a href='#'><i class='fa fa-pinterest'></i></a></li>
                                <li class='list-inline-item'><a href='#'><i class='fa fa-instagram'></i></a></li>
                            </ul>
                            </div>
                            </div>";
            }
        } else {
            $resUser .= "<h4 class='text-center text-thin w-100'>No planner posted yet.</h4>";
        }
        // TESTIMONIAL SECTION
        $testimoni = $this->tsti->getbyapproved()->getResult();
        $resTestimoni = "";
        if (count($testimoni) > 0) {
            foreach ($testimoni as $res) {
                $resTestimoni .= "<div class='swiper-slide'>
                                 <div class='testimonial'>
                                 <p class='feedback'>$res->isi</p>
                                 <div class='client'>
                                 <h4 class='name text-thin text-uppercase mb-0 mt-4'>$res->nama</h4>
                                 <span class='title'>$res->email</span>
                                 </div>
                                 </div>
                                 </div>";
            }
        } else {
            $resTestimoni .= "<h4 class='text-center text-thin w-100'>No testimonial posted yet.</h4>";
        }
        // ARTICLE SECTION
        $artikel = $this->artk->get_artikel()->getResult();
        $resArtikel = "";
        if (count($artikel) > 0) {
            foreach ($artikel as $res) {
                $subDesc = substr($res->description, 0, 120);
                $descTxt = ($subDesc . '...');
                $resArtikel .= "<div class='swiper-slide'>
                                <div class='property-listing-item mt-0 grid-full-width zooming'>
                                <div class='image'>
                                <a href='javascript:void(0)' onclick='detail($res->artikel_id)'>
                                <img src='" . base_url() . "/img/artikel/" . $res->artikel_img . "' class='img-fluid'>
                                </a>
                                </div>
                                <div style='padding:15px 0 15px 0;background:#FFF;'>
                                <a href='javascript:void(0)' onclick='detail($res->artikel_id)' class='no-anchor-style' style='height:100%;'>
                                <h2 class='h4 text-thin text-dark'>$res->artikel_nm</h2>
                                </a>
                                <p class='address' style='font-size:80%;'>$res->category_nm, " . pendek($res->dttm_artikel) . "</p>
                                <div style='font-size:15px !important;color:#343a40 !important;'>
                                $descTxt
                                </div>
                                <div class='d-flex align-items-center justify-content-between'>
                                <div class='left'>
                                <a href='javascript:void(0)' onclick='detail($res->artikel_id)' class='btn btn-sm btn-gradient'>Read More</a>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>";
            }
        } else {
            $resArtikel .= "<h4 class='text-center text-dark text-thin w-100'>No article posted yet.</h4>";
        }
        // VENDOR SECTION
        $vendor = $this->vndr->get_vendor()->getResult();
        $resVendor = "";
        if (count($vendor) > 0) {
            $resVendor .= "<section class='clients bg-black-4'><div class='container'><div class='swiper-container clients-slider'><div class='swiper-wrapper'>";
            foreach ($vendor as $res) {
                $resVendor .= "<div class='swiper-slide'>
                               <div class='client'><img src='" . base_url() . "/img/vendor/" . $res->image . "'></div>
                               </div>";
            }
            $resVendor .= "</div></div></div></section>";
        } else {
            $resVendor .= "";
        }

        $data = [
            'title'         => 'Beranda',
            'menu_nm'       => 'home',
            'resSlider'     => $resSlider,
            'resPortofolio' => $resPortofolio,
            'resUser'       => $resUser,
            'resProduct'    => $resProduct,
            'resTestimoni'  => $resTestimoni,
            'resArtikel'    => $resArtikel,
            'resVendor'     => $resVendor,
            'company'       => $company,
            'catPackage'    => $catPackage,
        ];
        return view('front/pages/home', $data);
    }
}

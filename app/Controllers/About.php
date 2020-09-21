<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
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
            'title'      => 'Tentang Kami',
            'menu_nm'    => 'about',
            'company'    => $company,
            'catPackage' => $catPackage,
            'resUser'    => $resUser,
            'resVendor'  => $resVendor,
        ];
        return view('front/pages/about', $data);
    }
}

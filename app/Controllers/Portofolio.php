<?php

namespace App\Controllers;

class Portofolio extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
        $portofolio = $this->port->get_portofolio()->getResult();
        $resPortofolio = "";
        $resSlider = "";
        if (count($portofolio) > 0) {
            foreach ($portofolio as $res) {
                $img = $this->port->getimageslim($res->portofolio_id)->getResult();
                $resPortofolio .= "<li>
                                   <figure>";
                foreach ($img as $key) {
                    $resPortofolio .= "<img src='" . base_url() . "/img/portofolio/" . $key->images_nm . "'>";
                }
                $resPortofolio .= "<figcaption>
                                   <h3>$res->portofolio_nm</h3>
                                   <p>$res->category_nm</p>
                                   </figcaption>
                                   </figure>
                                   </li>";
            }
            foreach ($portofolio as $res) {
                $img = $this->port->getimageslim($res->portofolio_id)->getResult();

                $resSlider .= "<li>
                               <figure>
                               <figcaption>
                               <h3>$res->portofolio_nm</h3>
                               <p>$res->category_nm</p>";
                foreach ($img as $key) {
                    $resSlider .= "<img src='" . base_url() . "/img/portofolio/" . $key->images_nm . "'>";
                }
                $resSlider .= "</figure></li>";
            }
        } else {
            $resPortofolio .= "<li class='text-center w-100 pb-5 pt-5'><h3 class='text-center text-dark text-thin'>No portofolio posted yet.</h3></li>";
        }

        $data = [
            'title'         => 'Portofolio',
            'menu_nm'       => 'portofolio',
            'company'       => $company,
            'contact'       => $this->comp->get_company()->getResult(),
            'catPackage'    => $catPackage,
            'resPortofolio' => $resPortofolio,
            'resSlider'     => $resSlider,
        ];
        return view('front/pages/portofolio', $data);
    }
}

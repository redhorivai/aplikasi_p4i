<?php

namespace App\Controllers;

class Gallery extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
        $gallery = $this->gall->get_gallery()->getResult();
        $resGallery = "";
        $resSlider = "";
        if (count($gallery) > 0) {
            foreach ($gallery as $res) {
                $img = $this->gall->getimageslim($res->gallery_id)->getResult();
                $resGallery .= "<li>
                                   <figure>";
                foreach ($img as $key) {
                    $resGallery .= "<img src='" . base_url() . "/img/gallery/" . $key->images_nm . "'>";
                }
                $resGallery .= "<figcaption>
                                   <h3>$res->gallery_nm</h3>
                                   <p>$res->category_nm</p>
                                   </figcaption>
                                   </figure>
                                   </li>";
            }
            foreach ($gallery as $res) {
                $img = $this->gall->getimageslim($res->gallery_id)->getResult();

                $resSlider .= "<li>
                               <figure>
                               <figcaption>
                               <h3>$res->gallery_nm</h3>
                               <p>$res->category_nm</p>";
                foreach ($img as $key) {
                    $resSlider .= "<img src='" . base_url() . "/img/gallery/" . $key->images_nm . "'>";
                }
                $resSlider .= "</figure></li>";
            }
        } else {
            $resGallery .= "";
        }
        $data = [
            'title'      => 'Galeri',
            'menu_nm'    => 'gallery',
            'company'    => $company,
            'catPackage' => $catPackage,
            'resGallery' => $resGallery,
            'resSlider'  => $resSlider,
        ];
        return view('front/pages/gallery', $data);
    }
}

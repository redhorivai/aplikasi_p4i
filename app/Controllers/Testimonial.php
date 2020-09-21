<?php

namespace App\Controllers;

class Testimonial extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
        $data = [
            'title'      => 'Testimonial',
            'menu_nm'    => 'testimonial',
            'company'    => $company,
            'catPackage' => $catPackage,
        ];
        return view('front/pages/testimonial', $data);
    }
}

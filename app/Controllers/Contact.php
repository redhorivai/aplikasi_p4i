<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $company = $this->comp->get_company()->getResult();
        $catPackage = $this->cate->get_catPackage()->getResult();
        $data = [
            'title'      => 'Kontak Kami',
            'menu_nm'    => 'contact',
            'company'    => $company,
            'contact'    => $this->comp->get_company()->getResult(),
            'catPackage' => $catPackage,
        ];
        return view('front/pages/contact', $data);
    }
}

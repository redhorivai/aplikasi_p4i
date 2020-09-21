<?php

namespace App\Controllers;

class Articles extends BaseController
{
  public function index()
  {
    $company = $this->comp->get_company()->getResult();
    $catPackage = $this->cate->get_catPackage()->getResult();
    $product = $this->prod->get_product()->getResult();
    $artikel = $this->artk->get_artikel()->getResult();
    $resArtikel = "";
    if (count($artikel) > 0) {
      $resArtikel .= "<div class='property-listing col-lg-9'><div class='row'>";
      foreach ($artikel as $res) {
        $subDesc = substr($res->description, 0, 120);
        $descTxt = ($subDesc . '...');
        $tglArtikel = pendek($res->created_dttm);
        $resArtikel .= "<div class='col-lg-4'>
                        <div class='property-listing-item zooming mt-0 mb-4'>
                        <div class='image'>
                        <a href='javascript:void(0)' onclick='detail($res->artikel_id)'>
                        <img src='" . base_url() . "/img/artikel/" . $res->artikel_img . "' class='img-fluid'>
                        </a>
                        </div>
                        <div style='padding:15px 0 15px 0;background:#FFF;'>
                        <a href='javascript:void(0)' onclick='detail($res->artikel_id)' class='no-anchor-style' style='height:100%;'>
                        <h2 class='h4 text-thin text-dark'>$res->artikel_nm</h2>
                        </a>
                        <p class='address' style='font-size:80%;'>$res->category_nm, $tglArtikel</p>
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
      $resArtikel .= "</div>
                     <div class='property-listing-footer mb-5'>
                     <div class='d-flex justify-content-between align-items-center'>
                     <div class='left mt-5'>
                     <p class='mb-0 text-dark'>Showing <span class='text-dark'>1 </span> of <span class='text-dark'>6 </span></p>
                     </div>
                     <div class='right mt-5'>
                     <nav aria-label='Page navigation example'>
                     <ul class='pagination m-0'>
                     <li class='page-item'><a href='#' aria-label='Previous' class='page-link'><span aria-hidden='true'>«</span><span class='sr-only'>Previous</span></a></li>
                     <li class='page-item'><a href='#' class='page-link active'>1</a></li>
                     <li class='page-item'><a href='#' class='page-link'>2</a></li>
                     <li class='page-item'><a href='#' class='page-link'>3</a></li>
                     <li class='page-item'><a href='#' aria-label='Next' class='page-link'><span aria-hidden='true'>»</span><span class='sr-only'>Next</span></a></li>
                     </ul>
                     </nav>
                     </div>
                     </div>
                     </div>
                     </div>";
    } else {
      $resArtikel .= "<div class='property-listing col-lg-9'>
                      <div class='row align-items-stretch'>
                      <div class='swiper-slide'>
                      <h2 class='h3 text-center text-dark text-thin w-100' style='padding-top:10rem;'>No article posted yet.</h2>
                      </div>
                      </div>
                      </div>";
    }

    $data = [
      'title'      => 'Artikel',
      'menu_nm'    => 'articles',
      'company'    => $company,
      'catPackage' => $catPackage,
      'product'    => $product,
      'artikel'    => $artikel,
      'resArtikel' => $resArtikel,
      'tglArtikel' => $tglArtikel,
    ];
    return view('front/pages/articles', $data);
  }

  public function detail_articles($id)
  {
    $company = $this->comp->get_company()->getResult();
    $catPackage = $this->cate->get_catPackage()->getResult();
    $artikel = $this->artk->getbyid($id)->getResult();
    $resDetail = "";
    foreach ($artikel as $res) {
      // $tglArtikel = panjang($res->created_dttm);
      $resDetail .= "<div class='row d-flex'>
                     <div class='col-lg-12'>
                     <h2 class='text-center text-thin' style='font-size:0.85rem;color:#999;'>" . panjang($res->created_dttm) . "</h2>
                     <h2 class='text-dark text-center text-thin'>$res->artikel_nm</h2>
                     <div class='row'>
                     <div class='col-lg-3'></div>
                     <div class='col-lg-6 mb-4 mt-4'>
                     <img src='" . base_url() . "/img/artikel/" . $res->artikel_img . "' class='img-fluid'>
                     </div>
                     </div>
                     <div class='articles'>
                     $res->description
                     </div>
                     </div>
                     </div>";
    }

    $data = [
      'title'      => 'Articles',
      'menu_nm'    => 'articles',
      'company'    => $company,
      'catPackage' => $catPackage,
      'resDetail'  => $resDetail,
    ];
    return view('front/pages/detail_articles', $data);
  }
}

<?php

namespace App\Controllers;

class Packages extends BaseController
{
  public function index()
  {
    $id = $this->request->uri->getSegment(3);
    $company = $this->comp->get_company()->getResult();
    $catPackage = $this->cate->get_catPackage()->getResult();
    $product = $this->prod->get_product($id)->getResult();
    $resProduct = "";
    if (count($product) > 0) {
      $resProduct .= "<div class='property-listing col-lg-9'><div class='row align-items-stretch'>";
      foreach ($product as $res) {
        if (!empty($res->price2)) {
          $ribbon = "<div class='ribbon-promo text-center'><strong>PROMO</strong></div>";
          $harga = "<del>Rp " . number_format($res->price1, 0, ',', '.') . "</del> Rp " . number_format($res->price2, 0, ',', '.') . "";
        } else {
          $ribbon = "";
          $harga = "Rp " . number_format($res->price1, 0, ',', '.') . "";
        }
        $resProduct .= "<div class='col-lg-4'>
                        <div class='property mb-5 mb-lg-0' style='height:430px;margin-top:40px;'>
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
                        <div class='price text-light'>
                        $harga
                        </div>
                        </div>
                        </div>
                        </div>";
      }
      $resProduct .= "</div>
            <div class='property-listing-footer'>
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
      $resProduct .= "<div class='property-listing col-lg-9'>
                            <div class='row align-items-stretch'>
                            <div class='swiper-slide'>
                            <h2 class='h3 text-center text-dark text-thin w-100' style='padding-top:10rem;'>No package posted yet.</h2>
                            </div>
                            </div>
                            </div>";
    }
    $data = [
      'title'      => 'Semua Paket',
      'menu_nm'    => 'packages',
      'company'    => $company,
      'catPackage' => $catPackage,
      'product'    => $product,
      'resProduct' => $resProduct,
    ];
    return view('front/pages/packages', $data);
  }

  public function detail_packages($id)
  {
    $company = $this->comp->get_company()->getResult();
    $catPackage = $this->cate->get_catPackage()->getResult();
    $product = $this->prod->getbyid($id)->getResult();
    $resDetail = "";
    foreach ($product as $res) {
      if (!empty($res->price2)) {
        $ribbon = "<div class='badge badge-info' style='float:right;padding:8px;'>PROMO</div>";
        $harga = "<del style='font-size:.9rem;'>Rp " . number_format($res->price1, 0, ',', '.') . "</del> Rp " . number_format($res->price2, 0, ',', '.') . "";
      } else {
        $ribbon = "";
        $harga = "Rp " . number_format($res->price1, 0, ',', '.') . "";
      }
      $resDetail .= "<div class='row'>
      <div class='col-lg-7'>
        <!-- IMAGE -->
        <div class='swiper-container gallery-top'>
          <div class='swiper-wrapper'>
            <div style='background: url(/assets/img/product1.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product2.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product3.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product4.jpg); background-size: cover;' class='swiper-slide'></div>
          </div>
        </div>
        <div class='swiper-container gallery-thumbs'>
          <div class='swiper-wrapper'>
            <div style='background: url(/assets/img/product1.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product2.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product3.jpg); background-size: cover;' class='swiper-slide'></div>
            <div style='background: url(/assets/img/product4.jpg); background-size: cover;' class='swiper-slide'></div>
          </div>
        </div>
        <!-- END IMAGE -->
      </div>

      <!-- PRODUCT DESCRIPTION -->
      <div class='col-lg-5'>
        <div class='property-single-author bg-black-3'>
          $ribbon
          <div class='d-flex align-items-center'>
            <div class='text'>
              <strong style='font-size:1.5rem;'>$res->product_nm</strong>
              <span class='mb-3'>$res->category_nm</span>
            </div>
          </div>
          <h3 class='h4 has-line text-thin mb-4'>$harga</h3>
          <div style='color:#999;font-size:14px;'>
            $res->description
          </div>
        </div>
      </div>
      <!-- END PRODUCT DESCRIPTION -->
    </div>";
    }

    $data = [
      'title'      => 'Packages',
      'menu_nm'    => 'packages',
      'company'    => $company,
      'catPackage' => $catPackage,
      'resDetail'  => $resDetail,
    ];
    return view('front/pages/detail_packages', $data);
  }
}

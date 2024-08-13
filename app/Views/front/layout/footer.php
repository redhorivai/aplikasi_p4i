<footer id="footer" class="footer pb-0" data-bg-color="#25272e">
    <div class="container pt-90 pb-60">
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="widget dark">
            <h5 class="widget-title line-bottom-theme-colored-2">Artikel Terbaru</h5>
            <div class="latest-posts">
              <?php 
                foreach($artikelFooter as $key){
                  if (empty($key->thumbnail_nm)) {
                      $thumbnail = "<img src='".base_url()."/image/artikel/400x300.png'>";
                  } else {
                      $thumbnail = "<img src='".base_url()."/image/artikel/$key->thumbnail_nm'>";
                  }
                  $strTitle = strlen($key->title);
                  if ($strTitle >= 22) {
                  $title = substr($key->title, 0, 22);
                  $titleTxt = $title . '...';
                  } else {
                  $titleTxt = $key->title;
                  }
                  $tanggal = date('d F Y', strtotime($key->created_dttm));
                  
                    echo "<article class='post media-post clearfix pb-0 mb-10'>
                        <a class='post-thumb' href='".base_url('/informasi/detail_artikel/'.$key->artikel_id.'')."' style='width:30%;'>
                        ".$thumbnail."
                        </a>
                        <div class='post-right'>
                        <h5 class='post-title mt-0 mb-5'>
                        <a href='".base_url('/informasi/detail_artikel/'.$key->artikel_id.'')."'>".$titleTxt."</a>
                        </h5>
                        <p class='post-date mb-0 font-12'>".$tanggal."</p>
                        </div>
                        </article>";
                  
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="horizontal-contact-widget mt-30 pt-30 text-center">
            <?php 
              foreach($dataInstansi as $key){
                echo "<div class='col-sm-12 col-sm-4 mt-sm-50'>
                        <div class='each-widget'> <i class='pe-7s-phone font-36 mb-10'></i>
                          <h5 class='text-white'>Hubungi Kami</h5>
                          <p class='mb-0'>Informasi: ".$key->cellphone_informasi."</p>
                          <p class='mb-0'>SMS Online: ".$key->cellphone_sms_online."</p>
                          <p class='mb-0'>Pemasaran: ".$key->cellphone_marketing."</p>
                        </div>
                      </div>
                      <div class='col-sm-12 col-sm-4 mt-sm-50'>
                        <div class='each-widget'> <i class='pe-7s-mail font-36 mb-10'></i>
                          <h5 class='text-white'>e-Mail</h5>
                          <p>".$key->email."</p>
                        </div>
                      </div>
                      <div class='col-sm-12 col-sm-4 mt-sm-50'>
                        <div class='each-widget'> <i class='pe-7s-map font-36 mb-10'></i>
                          <h5 class='text-white'>Alamat</h5>
                          <p>".$key->addr_txt."</p>
                        </div>
                      </div>";
              } 
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="list-inline styled-icons icon-hover-theme-colored icon-gray icon-circled text-center mt-30 mb-10">
            <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
            <li><a href="#"><i class="fa fa-instagram"></i></a> </li>
            <li><a href="#"><i class="fa fa-youtube"></i></a> </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-theme-colored p-20">
      <div class="row text-center">
        <div class="col-md-12">
          <p class="text-white font-11 m-0">Copyright <script>document.write(new Date().getFullYear())</script>
          binarykid. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
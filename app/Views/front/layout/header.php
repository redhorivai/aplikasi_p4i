<header id="header" class="header">
    <!-- HEADER TOP -->
    <div class="header-top sm-text-center" style="border-bottom: 1px solid rgb(229,232,237);">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="widget no-border m-0">
            </div>
          </div>
          <div class="col-md-9">
            <div class="widget no-border m-0">
              <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                <?php 
                  foreach($dataInstansi as $key){
                    echo "<li class='m-0 pl-10 pr-10' style='color: #5b6987 !important;'> 
                            <small><i class='fa fa-phone'></i> <b>".$key->cellphone_informasi."</b></small> 
                          </li>
                          <li class='m-0 pl-10 pr-10' style='color: #5b6987 !important;'> 
                            <small><i class='fa fa-envelope-o'></i> <b>".$key->email."</b></small> 
                          </li>";
                  } 
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- HEADER MENU -->
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-lightest" style="box-shadow: 0 4px 32px 0 rgba(10,14,29,.02),0 8px 64px 0 rgba(10,14,29,.08);">
        <div class="container">
          <nav id="menuzord-right" class="menuzord red bg-lightest">
            <a class="menuzord-brand pull-left flip" href="<?= base_url('/'); ?>">
              <!-- <img src="<?= base_url(); ?>/assets-front/images/p4i_logo.png"> -->
            </a>
            <!-- MENU -->
            <ul class="menuzord-menu">
              <li class="<?php if ($menu == 'home') { echo 'active'; } ?>">
                <?php if ($menu == 'home') {
                  echo "<a href='#home'>Beranda</a>";
                } else {
                  echo "<a href='".base_url('/')."'>Beranda</a>";
                } 
                ?>
              </li>
              <li class="<?php if ($menu == 'profil') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Profil</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/profil/tentangkami'); ?>">Tentang Kami</a></li>
                  <li><a href="<?= base_url('/profil/visimisi'); ?>">Visi dan Misi</a></li>
                </ul>
              </li>
              <li class="<?php if ($menu == 'informasi' || $menu == 'artikel' || $menu == 'ebook') { echo 'active'; } ?>">
                <a href="javascript:void(0)">Informasi</a>
                <ul class="dropdown">
                  <li><a href="<?= base_url('/informasi/artikel'); ?>">Artikel</a></li>
                  <li><a href="<?= base_url('/informasi/ebook'); ?>">Ebook </a></li>
                </ul>
              </li>
              <li class="<?php if ($menu == 'kontak') { echo 'active'; } ?>">
                <a href="<?= base_url('/kontak'); ?>">Kontak</a>
              </li>
              <li class="<?php if ($menu == 'login') { echo 'active'; } ?>">
                <a href="<?= base_url()?>/panel">|Login Members|</a>
              </li>
            </ul>
            <!-- END MENU -->
          </nav>
        </div>
      </div>
    </div>
</header>
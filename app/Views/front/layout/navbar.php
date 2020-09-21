    <!-- navbar-->
    <header class="header">
      <!-- Top Bar    -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 menu-left">
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
              </ul>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-right menu-right">
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="#" class="search-btn" style="text-transform: none !important;">
                    <i class="icon-search"></i> Search ...
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#" style="border-right: none !important; text-transform: none !important;">
                    <i class="fa fa-clock-o"></i>Senin - Sabtu (09:00 – 17:00 WIB)
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="search-area">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close<i class="icon-close-round"></i></div>
            <form class="search-form">
              <div class="form-group">
                <input type="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Navbar-->
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a href="<?= base_url('/'); ?>" class="navbar-brand" style="margin-right: 0 !important;">
            <?php foreach ($company as $res) : ?>
              <img src="<?= base_url(); ?>/img/company/<?= $res->company_logo; ?>" class="img-fluid" width="180">
            <?php endforeach ?>
          </a>
          <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><span></span><span></span><span></span></button>
          <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
              <?php
              if ($menu_nm == 'home') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/'); ?>" class="nav-link">Beranda</a>
              </li>

              <?php
              if ($menu_nm == 'about') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/about'); ?>" class="nav-link">Tentang Kami</a>
              </li>

              <!-- <li class="dropdown menu-large"><a id="megamenu" href="javascript:void(0)" data-toggle="dropdown" class="nav-link">Wedding Planner <i class="fa fa-angle-down"></i></a>
                <div aria-labelledby="megamenu" class="dropdown-menu megamenu">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-3"><strong class="text-uppercase">Category 1</strong>
                        <ul class="list-unstyled">
                          <li> <a href="javascript:void(0)">Product 1</a></li>
                          <li><a href="javascript:void(0)">Product 2</a></li>
                          <li><a href="javascript:void(0)">Product 3</a></li>
                          <li><a href="javascript:void(0)">Product 4</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-3"><strong class="text-uppercase">Category 2</strong>
                        <ul class="list-unstyled">
                          <li><a href="javascript:void(0)">Product 1</a></li>
                          <li><a href="javascript:void(0)">Product 2</a></li>
                          <li><a href="javascript:void(0)">Product 3</a></li>
                          <li><a href="javascript:void(0)">Product 4</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-3"><strong class="text-uppercase">Category 3</strong>
                        <ul class="list-unstyled">
                          <li><a href="javascript:void(0)">Product 1</a></li>
                          <li><a href="javascript:void(0)">Product 2</a></li>
                          <li><a href="javascript:void(0)">Product 3</a></li>
                          <li><a href="javascript:void(0)">Product 4</a></li>
                        </ul>
                      </div>
                      <div class="col-lg-3"><strong class="text-uppercase">Category 4</strong>
                        <ul class="list-unstyled">
                          <li><a href="javascript:void(0)">Product 1</a></li>
                          <li><a href="javascript:void(0)">Product 2</a></li>
                          <li><a href="javascript:void(0)">Product 3</a></li>
                          <li><a href="javascript:void(0)">Product 4</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a id="navbarDropdownMenuLink" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Dropdown <i class="fa fa-angle-down"></i>
                </a>
                <ul aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu">
                  <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                  <li><a href="#" class="dropdown-item nav-link">Another action</a></li>
                  <li class="dropdown-submenu"><a id="navbarDropdownMenuLink2" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Dropdown link <i class="fa fa-angle-down"></i></a>
                    <ul aria-labelledby="navbarDropdownMenuLink2" class="dropdown-menu">
                      <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                      <li class="dropdown-submenu"><a id="navbarDropdownMenuLink3" href="http://example.com/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">

                          Another action <i class="fa fa-angle-down"></i></a>
                        <ul aria-labelledby="navbarDropdownMenuLink3" class="dropdown-menu">
                          <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                          <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                          <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                          <li><a href="#" class="dropdown-item nav-link">Action</a></li>
                        </ul>
                      </li>
                      <li><a href="#" class="dropdown-item nav-link">Something else here </a></li>
                    </ul>
                  </li>
                </ul>
              </li> -->

              <?php
              if ($menu_nm == 'packages') {
                echo '<li class="nav-item dropdown active">';
              } else {
                echo '<li class="nav-item dropdown">';
              }
              ?>
              <a id="navbarDropdownMenuLink" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">Wedding Planner <i class="fa fa-angle-down"></i>
              </a>
              <ul aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu">
                <li>
                  <a href="<?= base_url('/packages/index'); ?>" class="dropdown-item nav-link text-uppercase">Semua Paket</a>
                </li>
                <?php foreach ($catPackage as $res) : ?>
                  <li><a href="<?= base_url('packages/index/' . $res->category_id . ''); ?>" class="dropdown-item nav-link text-uppercase"><?= $res->category_nm; ?></a></li>
                <?php endforeach ?>
              </ul>
              </li>

              <?php
              if ($menu_nm == 'articles') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/articles'); ?>" class="nav-link">Artikel</a>
              </li>

              <?php
              if ($menu_nm == 'portofolio') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/portofolio'); ?>" class="nav-link">Portofolio</a>
              </li>

              <?php
              if ($menu_nm == 'gallery') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/gallery'); ?>" class="nav-link">Galeri</a>
              </li>

              <?php
              if ($menu_nm == 'testimonial') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/testimonial'); ?>" class="nav-link">Testimonial</a>
              </li>

              <?php
              if ($menu_nm == 'contact') {
                echo '<li class="nav-item active">';
              } else {
                echo '<li class="nav-item">';
              }
              ?>
              <a href="<?= base_url('/contact'); ?>" class="nav-link">Kontak Kami</a>
              </li>
            </ul>
            <!-- <ul class="secondary-nav-menu list-inline ml-auto mb-0">
              <li class="list-inline-item"><a href="submit-property.html" class="btn btn-primary btn-gradient">Submit property</a></li>
            </ul> -->
          </div>
        </div>
      </nav>
    </header>
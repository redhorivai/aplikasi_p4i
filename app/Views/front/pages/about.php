<?= $this->extend('front/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- HEADER SECTION -->
<section class="hero-page bg-black-3" style="padding:25px 0px;">
  <div class="container">
    <h1 class="h2" style="font-size:1.5rem;"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Beranda</a></li>
        <li aria-current="page" class="breadcrumb-item active"><?= $title; ?></li>
      </ol>
    </nav>
  </div>
</section>
<!-- END HEADER SECTION -->
<!-- DESCRIPTION SECTION -->
<section class="about-brief bg-white">
  <div class="container" style="max-width:1250px;">
    <div class="row d-flex">
      <div class="col-lg-6 mb-3"><img src="/assets/img/hero-bg-1.jpg" class="img-fluid"></div>
      <div class="col-lg-6">
        <h2 class="h3 text-thin text-dark has-line">Momea Wedding Planner</h2>
        <p class="template-text" style="color:#666;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. LOLUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p class="template-text" style="color:#666;">LOLDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
      </div>
    </div>
  </div>
</section>
<!-- END DESCRIPTION SECTION -->

<!-- PLANNER SECTION -->
<section class="agents bg-black-2">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="text-light mb-0">Our <span class="text-primary">Planner</span></h2>
      <!-- <div class="row">
        <div class="col-lg-8 mx-auto">
          <p class="template-text">Blaaa blaaa blaaa blaaa blaaa.</p>
        </div>
      </div> -->
    </header>

    <div class="swiper-container planner-slider">
      <div class="swiper-wrapper pt-2 pl-2 pr-2">
        <?= $resUser; ?>
      </div>
    </div>

  </div>
</section>
<!-- END PLANNER SECTION -->

<!-- VENDOR SECTION -->
<?= $resVendor; ?>
<!-- END VENDOR SECTION -->
<?= $this->endSection(); ?>
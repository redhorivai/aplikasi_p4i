<?= $this->extend('front/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- HEADER SECTION -->
<section class="hero-page bg-black-3" style="padding:25px 0px;">
  <div class="container">
    <h1 class="h2" style="font-size:1.5rem;"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Beranda</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/packages'); ?>">Semua Paket</a></li>
        <li aria-current="page" class="breadcrumb-item active"><?= $title; ?></li>
      </ol>
    </nav>
  </div>
</section>
<!-- END HEADER SECTION -->
<!-- MAIN SECTION -->
<section class="property-single bg-white">
  <div class="container" style="max-width:1250px;">

    <?= $resDetail; ?>

    <!-- PRODUCT DETAILS -->
    <div class="property-single-details bg-black-3 mt-5 block">
      <h3 class="h4 has-line">Product Details</h3>
      <div class="row">
        <div class="col-lg-3"><strong>Property ID</strong><span>20142354</span></div>
        <div class="col-lg-3"><strong>Type of location</strong><span>Apartment</span></div>
        <div class="col-lg-3"><strong>Property status</strong><span>For sale</span></div>
        <div class="col-lg-3"><strong>Price</strong><span>$560,000</span></div>
        <div class="col-lg-3"><strong>Land area</strong><span>2356 sqft</span></div>
        <div class="col-lg-3"><strong>Bathrooms</strong><span>03</span></div>
        <div class="col-lg-3"><strong>Bedrooms</strong><span>05</span></div>
        <div class="col-lg-3"><strong>Year built</strong><span>2010</span></div>
      </div>
    </div>
    <!-- END PRODUCT DETAILS -->

    <!-- PRODUCT DESCRIPTION -->
    <!-- <div class="property-single-description bg-black-3 mt-5 block">
      <h3 class="h4 has-line">Product Description </h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. LOLUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      <p>LOLDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
    </div> -->
    <!-- END PRODUCT DESCRIPTION -->

    <!-- PRODUCT FEATURES -->
    <!-- <div class="property-single-features bg-black-3 mt-5 block">
      <h3 class="h4 has-line">Product Features</h3>
      <div class="row">
        <div class="col-lg-3">
          <div class="label-template-checkbox active">Swimming pool</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox">Air conditioning</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox active">Fireplace</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox">Garage</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox active">Balcony</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox active">Wifi</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox">Electric Range</div>
        </div>
        <div class="col-lg-3">
          <div class="label-template-checkbox active">Laundry</div>
        </div>
      </div>
    </div> -->
    <!-- END PRODUCT FEATURES -->

    <!-- PRODUCT VIDEO -->
    <div class="property-single-video bg-black-3 mt-5 block">
      <h3 class="h4 has-line">Video Wedding</h3>
      <div class="video">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/g3tB7aFoyjY?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
      </div>
    </div>
    <!-- END PRODUCT VIDEO -->
  </div>
</section>
<!-- END DESCRIPTION SECTION -->
<?= $this->endSection(); ?>
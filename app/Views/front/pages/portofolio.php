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
<!-- MAIN SECTION -->
<div id="grid-gallery" class="grid-gallery bg-white">
  <section class="grid-wrap pb-5">
    <ul class="grid">
      <li class="grid-sizer"></li>
      <!-- MASONRY -->
      <?= $resPortofolio; ?>
    </ul>
  </section>
  <!-- END MANSORY -->

  <!-- SLIDESHOW -->
  <section class="slideshow">
    <ul>
      <?= $resSlider; ?>
    </ul>
    <nav><span class="icon nav-prev"></span><span class="icon nav-next"></span><span class="icon nav-close"></span></nav>
    <div class="info-keys icon">Navigate with arrow keys</div>
  </section>
  <!-- END SLIDESHOW -->

</div>
<!-- END MAIN SECTION -->
<?= $this->endSection(); ?>
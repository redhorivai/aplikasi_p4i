<?= $this->extend('front/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- HEADER SECTION -->
<section class="hero-page bg-black-3" style="padding:25px 0px;">
  <div class="container">
    <h1 class="h2" style="font-size:1.5rem;"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Beranda</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/articles'); ?>">Artikel</a></li>
        <li aria-current="page" class="breadcrumb-item active">Detail Articles</li>
      </ol>
    </nav>
  </div>
</section>
<!-- END HEADER SECTION -->

<section class="about-brief bg-white">
  <div class="container">
    <?= $resDetail; ?>
  </div>
</section>
<?= $this->endSection(); ?>
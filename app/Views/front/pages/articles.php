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
<section class="about-brief bg-white">
  <div class="container" style="max-width:1250px;">
    <div class="row">
      <!-- ARTICLES -->
      <?= $resArtikel; ?>
      <!-- END ARTICLES -->

      <!-- SIDEBAR -->
      <div class="col-lg-3">
        <div class="property-listing-sidebar">
          <!-- WIDGET ARTICLES -->
          <div class="widget featured-widget mt-0">
            <div class="widget-header mb-3"><strong class="has-line">Latest Articles</strong></div>
            <?php if (count($artikel) > 0) {
              foreach ($artikel as $res) {
                $subJudul = substr($res->artikel_nm, 0, 25);
                $judulTxt = ($subJudul . '...');
                echo "<div class='property-thumb d-flex align-items-center mb-0'>
                      <div class='image'><img src='" . base_url() . "/img/artikel/" . $res->artikel_img . "' class='img-fluid'></div>
                      <div class='text' style='margin-top:-30px;'>
                      <a href='javascript:void(0)' onclick='detail($res->artikel_id)' class='no-anchor-style'>$judulTxt</a>
                      <p>$tglArtikel</p>
                      </div>
                      </div>";
              }
            } else {
              echo "<p class='text-center text-thin' style='font-size:13px;'>No article posted yet.</p>";
            }
            ?>
          </div>
          <!-- END WIDGET ARTICLES -->
          <!-- WIDGET PRODUCT -->
          <div class="widget featured-widget">
            <div class="widget-header mb-3"><strong class="has-line">Recently Viewed Packages</strong></div>
            <?php if (count($product) > 0) {
              foreach ($product as $res) {
                echo "<div class='property-thumb d-flex align-items-center'>
                      <div class='image'><img src='/assets/img/property-thumb-2.jpg' class='img-fluid'></div>
                      <div class='text'><a href='#' class='no-anchor-style'>Rivington Hopoken</a>
                      <p>GTb Financial destrict, New York</p><span class='price'>$54.000</span>
                      </div>
                      </div>";
              }
            } else {
              echo "<p class='text-center text-thin' style='font-size:13px;'>No package posted yet.</p>";
            }
            ?>
          </div>
          <!-- END WIDGET PRODUCT -->
        </div>
      </div>
      <!-- END SIDEBAR -->
    </div>
  </div>
</section>
<!-- END MAIN SECTION -->
<script>
  function detail(id) {
    window.location.href = "<?= base_url() ?>/articles/detail_articles/" + id;
  }
</script>
<?= $this->endSection(); ?>
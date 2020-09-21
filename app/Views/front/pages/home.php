<?= $this->extend('front/layout/template') ?>

<?= $this->section('content'); ?>
<!-- SLIDER SECTION -->
<section class="hero-section bg-black-3">
  <div class="swiper-container hero-slider">
    <div class="swiper-wrapper">
      <?= $resSlider; ?>
    </div>
    <!-- <div class="swiper-pagination"></div> -->
  </div>
</section>
<!-- END SLIDER SECTION -->

<!-- WELCOME SECTION -->
<section class="bg-white">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="text-dark mb-0">Welcome To <span class="text-primary">Momea Wedding Planner</span></h2>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p class="template-text" style="color:#666;">We create the wedding of your dreams, where ever your heart is</p>
        </div>
      </div>
    </header>
    <div class="row">

      <div class="col-md-5 mb-3">
        <div class="port-7 effect-2">
          <div class="image-box">
            <img src="/assets/img/ab.jpg">
          </div>
          <div class="text-desc">
            <h4>Momea Wedding Planner</h4>
            <p>It's All About The Day</p>
          </div>
        </div>
      </div>

      <div class="col-md-7">
        <h4 class="text-dark">Momea Wedding Planner</h4>
        <p style="color: #666;">Lorem ipsum dolor sit ame sectetur adipsing elit. Praesent eu est quilrs turpis posuere sodales. Mauris tempus placerat felvel iaculis. Suspendisse blandit id dolor eu bibendum. Integer gravida diam ut quam eleifend, sed tristiqu diam laoreet. Donec ac gravida urna. Sed ut nibh posuere euismod est</p>
        <p style="color: #666;">Duis aute irure dolor in reprehenderit in voluptate Praesent eu est quilrs turpis posuere sodales. elit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor. reprehenderit</p>
      </div>

    </div>
  </div>
</section>
<!-- END SECTION WELCOME -->

<!-- PACKAGES SECTION -->
<section class="apartments bg-black-3">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="mb-0">Wedding <span class="text-primary">Planner</span></h2>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p class="template-text">It's All About The Day</p>
        </div>
      </div>
    </header>
    <div class="swiper-container venue-slider">
      <div class="swiper-wrapper pt-2 pb-5">
        <?= $resProduct; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<!-- END PACKAGES SECTION -->

<!-- WHY CHOOSE US SECTION -->
<div class="agile-dot">
  <section class="advantages jarallax">
    <div class="container" style="max-width:1250px;">
      <header class="text-center">
        <h2 class="text-light mb-0">Why <span class="text-primary">Choose Us?</span></h2>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <p class="template-text" style="color:#FFF;">We create the wedding of your dreams, where ever your heart is</p>
          </div>
        </div>
      </header>
      <div class="row">
        <div class="col-md-4 advantage-grid">
          <div class="advantage-block">
            <h3>01</h3>
            <h4>Eveniet voluptates</h4>
            <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates.</p>
          </div>
        </div>
        <div class="col-md-4 advantage-grid">
          <div class="advantage-block">
            <h3>02</h3>
            <h4>Voluptates repudiandae</h4>
            <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates.</p>
          </div>
        </div>
        <div class="col-md-4 advantage-grid">
          <div class="advantage-block">
            <h3>03</h3>
            <h4>Molestiae recusandae</h4>
            <p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- END WHY CHOOSE US SECTION -->

<!-- THE WEDDING SECTION -->
<section class="listings-home bg-black-3">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="mb-0">The <span class="text-primary">Wedding</span></h2>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <p class="template-text">We make your special day to be a beatifull day. </p>
        </div>
      </div>
    </header>
    <div class="row">
      <?= $resPortofolio; ?>
    </div>
  </div>
</section>
<!-- END THE WEDDING SECTION -->

<!-- PLANNER SECTION -->
<section class="agents bg-white">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="text-dark mb-0">Our <span class="text-primary">Planner</span></h2>
    </header>
    <div class="swiper-container planner-slider">
      <div class="swiper-wrapper pt-2 pl-2 pr-2">

        <?= $resUser; ?>

      </div>
    </div>

  </div>
</section>
<!-- END PLANNER SECTION -->

<!-- TESTIMONIAL SECTION -->
<section class="testimonials bg-black-3">
  <div class="container">
    <header class="text-center">
      <h2>Client <span class="text-primary">Testimonials</span></h2>
    </header>
    <div class="swiper-container testimonials-slider">
      <div class="swiper-wrapper pt-2 pb-5">
        <?= $resTestimoni; ?>
      </div>
      <!-- <div class="swiper-pagination"></div> -->
    </div>
  </div>
</section>
<!-- END TESTIMONIAL SECTION -->

<!-- ARTICLES SECTION -->
<section class="agents bg-white">
  <div class="container" style="max-width:1250px;">
    <header class="text-center">
      <h2 class="text-dark mb-0">Latest <span class="text-primary">Articles</span></h2>
    </header>
    <div class="swiper-container planner-slider">
      <div class="swiper-wrapper pt-2 pl-2 pr-2">
        <?= $resArtikel; ?>
      </div>
    </div>
  </div>
</section>
<!-- END ARTICLES SECTION -->

<!-- VENDOR SECTION -->
<?= $resVendor; ?>
<!-- END VENDOR SECTION -->
<script>
  function detail(id) {
    window.location.href = "<?= base_url() ?>/articles/detail_articles/" + id;
  }

  function detailPackages(id) {
    window.location.href = "<?= base_url() ?>/packages/detail_packages/" + id;
  }
</script>
<?= $this->endSection() ?>
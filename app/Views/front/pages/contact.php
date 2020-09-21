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
      <div class="col-lg-6">
        <h2 class="h3 text-thin text-dark has-line">Get in touch</h2>
        <div class="agileits-contact-address">
          <?php foreach ($contact as $res) : ?>
            <table>
              <tr>
                <td><i class="fa fa-phone" aria-hidden="true"></i></td>
                <td><span><?= $res->company_phone; ?></span></td>
              </tr>
              <tr>
                <td><i class="fa fa-phone fa-envelope" aria-hidden="true"></i></td>
                <td><span><a href="mailto:<?= $res->company_email; ?>"><?= $res->company_email; ?></a></span></td>
              </tr>
              <tr>
                <td><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                <td><span><?= $res->company_address; ?></span></td>
              </tr>
            </table>
          <?php endforeach ?>
        </div>
      </div>
      <div class="col-lg-6 mb-3">
        <h2 class="h3 text-thin text-dark has-line">Find us here</h2>
        <div class="w3agile-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3984.4464882414686!2d104.736667!3d-2.9735211!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b75c31892d08f%3A0x5139d57615af105a!2sMomea%20104.2%20Fm!5e0!3m2!1sid!2sid!4v1599416465355!5m2!1sid!2sid" allowfullscreen="">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END DESCRIPTION SECTION -->
<?= $this->endSection(); ?>
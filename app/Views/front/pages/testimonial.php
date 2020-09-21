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
<section class="customer-login bg-black-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6 mt-5 mt-lg-0">
        <h2 class="has-line">Send Us Some Testimonial</h2>
        <h4 class="text-thin">Blaaa.. Blaaa..</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. LOLUt enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <hr>
        <form action="#" class="login-form">
          <div class="form-group">
            <input type="text" name="name" placeholder="Type your full name" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="email" placeholder="Type your email address" class="form-control">
          </div>
          <div class="form-group">
            <textarea name="message" placeholder="Message" class="form-control"></textarea>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-gradient">Kirim Testimonial</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- END MAIN SECTION -->
<?= $this->endSection(); ?>
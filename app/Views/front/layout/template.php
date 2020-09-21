<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php if ($title == 'Home') {
      echo 'Momea Wedding Planner';
    } else {
      echo '' . $title . ' | Momea Wedding Planner';
    }
    ?>
  </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <!-- Favicon-->
  <link rel="shortcut icon" href="<?= base_url(); ?>/assets/img/favicon.ico">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/font-awesome/css/font-awesome.min.css">
  <!-- Fontastic-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/fontastic.css">
  <!-- Bootstrap Select-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/bootstrap-select/css/bootstrap-select.css">
  <!-- Google fonts - Poppins-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700">
  <!-- swiper carousel-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/swiper/css/swiper.css">
  <!-- Gallery-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/gallery.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.default.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/custom.css">
  <!-- Modernizr-->
  <script src="<?= base_url(); ?>/assets/js/modernizr.custom.js"></script>
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/5f57c4724704467e89ed3a76/default';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
</head>

<body id="home">

  <?= $this->include('front/layout/navbar'); ?>

  <?= $this->renderSection('content'); ?>

  <!-- FOOTER -->
  <footer class="footer bg-black-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 brief">
          <h3 class="h4 text-thin text-uppercase">Momea Wedding Planner </h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna </p>
          <ul class="social list-inline">
            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa fa-whatsapp"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-2 links">
          <h3 class="h4 text-thin text-uppercase">Company</h3>
          <ul class="list-unstyled">
            <li><a href="#">Properties</a></li>
            <li><a href="#">Landlords</a></li>
            <li><a href="#">Renters</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Pricing</a></li>
          </ul>
        </div>
        <div class="col-lg-2 links">
          <h3 class="h4 text-thin text-uppercase">Support</h3>
          <ul class="list-unstyled">
            <li><a href="#">Help & FAQ</a></li>
            <li><a href="#">Policy Privacy</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Our Partners</a></li>
          </ul>
        </div>
        <div class="col-lg-4 newsletter">
          <h3 class="h4 text-thin text-uppercase">Newsletter</h3>
          <p>p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>
          <form class="newsletter-form">
            <div class="form-group">
              <input type="email" name="email" placeholder="Enter your email address" class="form-control">
              <button type="submit" class="btn btn-gradient submit"><i class="icon-email-plane"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="w3_agile_footer">
      <div class="container">
        <p class="mb-0">&copy;2020 <a href="<?= base_url('/'); ?>">Momea Wedding Planner</a> | All Rights Reserved.</p>
        <div class="arrow-container animated fadeInDown">
          <a href="#home" class="arrow-2 scroll">
            <i class="fa fa-angle-up"></i>
          </a>
          <div class="arrow-1 animated hinge infinite zoomIn"></div>
        </div>
      </div>
    </div>
  </footer>
  <!-- END FOOTER -->

  <!-- JS -->
  <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/popper.js/umd/popper.min.js"> </script>
  <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/bootstrap-select/js/bootstrap-select.js"></script>
  <script src="<?= base_url() ?>/assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="<?= base_url() ?>/assets/vendor/swiper/js/swiper.js"></script>
  <script src="<?= base_url() ?>/assets/js/jarallax.js"></script>
  <script src="<?= base_url() ?>/assets/js/front.js"></script>
  <script src="<?= base_url() ?>/assets/js/imagesloaded.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/masonry.pkgd.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/classie.js"></script>
  <script src="<?= base_url() ?>/assets/js/cbpGridGallery.js"></script>
  <script src="<?= base_url() ?>/assets/js/swiper-thumbs.js"></script>
  <script>
    new CBPGridGallery(document.getElementById('grid-gallery'));
  </script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
          scrollTop: $(this.hash).offset().top
        }, 1000);
      });
    });
    $('.jarallax').jarallax({
      speed: 0.5,
      imgWidth: 1366,
      imgHeight: 768
    });
  </script>
</body>

</html>
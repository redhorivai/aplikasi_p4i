<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- SEO Meta description -->
    <meta name="description" content="Login Area">
    <meta name="author" content="redhorivai">
    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content=""/> <!-- website name -->
    <meta property="og:site" content=""/> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content=""/> <!-- description shown in the actual shared post -->
    <meta property="og:image" content=""/> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content=""/> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article"/>
    <!--title-->
    <title>Daftar Area</title>
    <link href="<?= base_url(); ?>/assets-admin/panel/images/logo/logo_p4i.ico" rel="shortcut icon">
    <!--google fonts-->
    <link href="../fonts.googleapis.com/csse945.css?family=Montserrat:400,500,600,700%7COpen+Sans&amp;display=swap"
          rel="stylesheet">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/bootstrap.min.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/themify-icons.css">
    <!--custom css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/login/css/responsive.css">
</head>
<body>
<!-- PRELOADER -->
<div id="preloader">
    <div class="loader1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END PRELOADER -->

<!--body content wrap start-->
<div class="main">
    <!--hero section start-->
    <section class="hero-section gradient-overlay full-screen">
        <div class="container">
            <div class="row align-items-center justify-content-between pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                <div class="col-md-4">
                    <div class="hero-content-left text-white">
                        <h1 class="text-white mb-0">Daftar Anggota</h1>
                        <p class="lead">P4i Parasit Indonesia </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card login-signup-card shadow-lg mb-0 ml-3 mr-3">
                        <div class="card-body px-md-5 py-4">
                            <div class="mb-5">
                                <h5 class="h3">Login</h5>
                                <!-- <p class="text-muted mb-0">Sign in to your account to continue.</p> -->
                            </div>
                            <!-- LOGIN FORM -->
                            <form id="login_form" class="login-signup-form">
							<?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Nama Lengkap <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama Lengkap" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Username <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Nomor Identitas <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>
                                            <input type="number" id="nik" name="nik" class="form-control" placeholder="Masukkan NIK" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Jenis Kelamin <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>
                                            <select class='form-control select2' id='gender' name='gender' data-placeholder='-- Pilih Aplikasi --' data-allow-clear='true' style='width:100%'>
                                            <option value=''></option>
                                            <option value='L'>Laki-laki</option>
                                            <option value='P'>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Email <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-email color-primary"></span>
                                            </div>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">No Telepon <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-mobile color-primary"></span>
                                            </div>
                                            <input type="number" id="phone" name="phone" class="form-control" placeholder="Masukkan Nomor Telepon" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Tempat Lahir <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-layout-cta-center color-primary"></span>
                                            </div>
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Tanggal Lahir <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-comments color-primary"></span>
                                            </div>
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" style="text-transform:lowercase;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Status Pengguna <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-icon">
                                                <span class="ti-user color-primary"></span>
                                            </div>
                                            <select class='form-control select2' id='level' name='level' data-placeholder='-- Pilih Aplikasi --' data-allow-clear='true' style='width:100%'>
                                            <option value=''></option>
                                            <option value='User'>Anggota</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="pb-1">Alamat <span class='tx-danger' style='color:#cf3030'>*</span></label>
                                        <textarea rows='3' id='address' name='address' class='form-control'></textarea>
                                    </div>
                                </div>
                            </div>
                                <button  class="btn btn-block solid-btn border-radius nav-link mt-4 mb-3" onclick="_BtnSimpan()">
                                    Daftar
                                </button>
							</form>
							<!-- END LOGIN FORM -->
                        </div>
                        <div class="card-footer text-center bg-transparent border-top px-md-5">
							<small>Sudah memiliki akun?<a href="<?= base_url()?>/panel" style="color:#21b42d;"> Login</a></small>
						</div>
				</div>
				<div class="col-md-4"></div>
            </div>
        </div>
        <div class="shape-bottom">
            <img src="<?= base_url(); ?>/assets-admin/login/images/hero-shape-bottom.svg" class="bottom-shape img-fluid">
        </div>
    </section>
    <!--hero section end-->
</div>
<script>
    // $('.select2').select2();
    // $('#btnCancelForm').click(function() {
    // $('.form-data')[0].reset();
    // $('#name').removeClass('is-invalid');
    // $('#username').removeClass('is-invalid');
    // $('#nik').removeClass('is-invalid');
    // $('#gender').removeClass('is-invalid');
    // $('#email').removeClass('is-invalid');
    // $('#phone').removeClass('is-invalid');
    // $('#tempat_lahir').removeClass('is-invalid');
    // $('#tanggal_lahir').removeClass('is-invalid');
    // $('#level').removeClass('is-invalid');
    // $('#address').removeClass('is-invalid');
    // $('#formData').addClass('d-none');
    // $('#viewData').delay(100).fadeIn();
    // });
</script>

<!--jQuery-->
<script src="<?= base_url(); ?>/assets-admin/login/js/jquery-3.4.1.min.js"></script>
<!--Popper js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/popper.min.js"></script>
<!--Bootstrap js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/login/js/sweetalert2.all.min.js"></script>
<!--custom js-->
<script src="<?= base_url(); ?>/assets-admin/login/js/validasi-login.js"></script>
<script src="<?= base_url(); ?>/assets-admin/login/js/scripts.js"></script>
<script type="text/javascript">

// function _simpan() {
//         var name     = $("#name").val();
//         var username = $("#username").val();
//         var no_id    = $("#no_id").val();
//         var gender   = $("#gender").val();
//         var email     = $("#email").val();
//         var phone = $("#username").val();
//         var tempat_lahir    = $("#tempat_lahir").val();
//         var tanggal_lahir   = $("#tanggal_lahir").val();
//         var level    = $("#level").val();
//         var address  = $("#address").val();
//         if (name == "") {
//             $("#name").focus();
//             $('#name').addClass('is-invalid');
//         } else {
//             $('#name').removeClass('is-invalid');
//         }
//         if (username == "") {
//             $('#username').addClass('is-invalid');
//         } else {
//             $('#username').removeClass('is-invalid');
//         }
//         if (no_id == "") {
//             $('#no_id').addClass('is-invalid');
//         } else {
//             $('#no_id').removeClass('is-invalid');
//         }
//         if (gender == "") {
//             $("#gender + span").addClass("is-invalid");
//             $("#gender + span").focus(function() {
//                 $(this).addClass("is-invalid");
//             });
//         } else {
//             $('#gender').removeClass('is-invalid');
//             $("#gender + span").removeClass("is-invalid");
//             $("#gender + span").focus(function() {
//                 $(this).removeClass("is-invalid");
//             });
//         }
//         if (email == "") {
//             $("#email").focus();
//             $('#email').addClass('is-invalid');
//         } else {
//             $('#email').removeClass('is-invalid');
//         }
//         if (phone == "") {
//             $('#phone').addClass('is-invalid');
//         } else {
//             $('#phone').removeClass('is-invalid');
//         }
//         if (tempat_lahir == "") {
//             $("#tempat_lahir").focus();
//             $('#tempat_lahir').addClass('is-invalid');
//         } else {
//             $('#tempat_lahir').removeClass('is-invalid');
//         }
//         if (tanggal_lahir == "") {
//             $('#tanggal_lahir').addClass('is-invalid');
//         } else {
//             $('#tanggal_lahir').removeClass('is-invalid');
//         }
//         if (level == "") {
//             $("#level + span").addClass("is-invalid");
//             $("#level + span").focus(function() {
//                 $(this).addClass("is-invalid");
//             });
//         } else {
//             $('#level').removeClass('is-invalid');
//             $("#level + span").removeClass("is-invalid");
//             $("#level + span").focus(function() {
//                 $(this).removeClass("is-invalid");
//             });
//         }
//         if (address == "") {
//             $('#address').addClass('is-invalid');
//         } else {
//             $('#address').removeClass('is-invalid');
//         }
//         if (name && username && no_id && gender && email && phone && tempat_lahir && tanggal_lahir && level && address) {
//             $.ajax({
//                 url: "<?= site_url('Backend/Daftar/insert_data') ?>",
//                 type: "POST",
//                 data: {
//                     name     : name,
//                     username : username,
//                     no_id    : no_id,
//                     gender   : gender,
//                     email     : email,
//                     phone : phone,
//                     tempat_lahir    : tempat_lahir,
//                     tanggal_lahir   : tanggal_lahir,
//                     level    : level,
//                     address  : address
//                 },
//                 success: function(response) {
//                     if (response == "Sukses") {
//                         var $toast = Toast.fire({
//                             icon: "success",
//                             title: "Anda Berhasil Melakukan Pendaftaran"
//                         });
//                         $('.form-data')[0].reset();
//                         $('#formData').addClass('d-none');
//                         $('#viewData').delay(100).fadeIn();
//                     } else {
//                         $("#no_id").focus();
//                         $('#no_id').addClass('is-invalid');
//                         Swal.fire({
//                             title: 'Pemberitahuan',
//                             html: response,
//                             icon: 'warning',
//                             showConfirmButton: true,
//                         });
//                     }
//                 },
//                 error: function() {
//                     Toast.fire({
//                         icon: "error",
//                         title: "Error !, Silahkan coba beberapa saat lagi."
//                     });
//                 }
//             });
//         }
// }
function _BtnSimpan() {
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Data berhasil disimpan',
            showConfirmButton: false,
            timer: 3000
            });
    }
   
</script>
</body>
</html>
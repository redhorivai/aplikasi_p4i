<?php
$isi = current_url(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/img/favicon.ico">
    <!-- ICONS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/line_icon/css/simple-line-icons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SELECT2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- BOOTSTRAP FILE-INPUT -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/bootstrap-fileinput/bootstrap-fileinput.css">
    <!-- ICHECK BOOTSRAP -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- STYLE -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <!-- MAIN WRAPPER -->
    <div class="wrapper">
        <!-- NAVBAR HEADER -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- END NAVBAR HEADER -->


        <!-- SIDEBAR MENU -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
            <a href="javascript:void(0)" class="brand-link">
                <img id='logo' src="" class="brand-image d-nonew" style="opacity: .8;min-height:40px;width:100%;margin-left:0 !important;margin-right:0 !important;">
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image" style="margin-top: 5px;">
                        <?php
                        if (empty(session()->get('avatar')) && session()->get('gender') == 'L') {
                            echo '<img src="' . base_url() . '/img/user/avatar.png" class="img-circle elevation-2">';
                        } else if (empty(session()->get('avatar')) && session()->get('gender') == 'P') {
                            echo '<img src="' . base_url() . '/img/user/avatar3.png" class="img-circle elevation-2">';
                        } else if (!empty(session()->get('avatar'))) {
                            echo '<img src="' . base_url() . '/img/user/' . session()->get('avatar') . '" class="img-circle elevation-2">';
                        }
                        ?>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('name'); ?></a>
                        <small><a href="#" class="d-block"><?= session()->get('username'); ?></a></small>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header"><b>Navigation Menu</b></li>
                        <!-- MENU -->
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/Admin/dashboard') {
                                echo '<a href="' . base_url('/Admin/dashboard') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/Admin/dashboard') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-home"></i>
                            <p>Dashboard</p>
                            </a>
                        </li>
                        <?php
                        if ($isi == base_url() . '/Admin/category' || $isi == base_url() . '/Admin/slider' || $isi == base_url() . '/Admin/vendor') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == base_url() . '/Admin/category' || $isi == base_url() . '/Admin/slider' || $isi == base_url() . '/Admin/vendor') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-folder"></i>
                        <p>
                            Master Data
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 3px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == base_url() . '/Admin/slider') {
                                    echo '<a href="' . base_url('/Admin/slider') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('/Admin/slider') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Slider</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == base_url() . '/Admin/category') {
                                    echo '<a href="' . base_url('/Admin/category') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('/Admin/category') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php
                                if ($isi == base_url() . '/Admin/vendor') {
                                    echo '<a href="' . base_url('/Admin/vendor') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('/Admin/vendor') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Vendor</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/Admin/user') {
                                echo '<a href="' . base_url('/Admin/user') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/Admin/user') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-people"></i>
                            <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/Admin/product' || $isi == base_url() . '/Admin/product/formtambah') {
                                echo '<a href="' . base_url('/Admin/product') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/Admin/product') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-bag"></i>
                            <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/Admin/artikel' || $isi == base_url() . '/Admin/artikel/formtambah' || $isi == base_url() . '/Admin/artikel/formedit') {
                                echo '<a href="' . base_url('/Admin/artikel') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/Admin/artikel') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-note"></i>
                            <p>Artikel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/admin/testimoni') {
                                echo '<a href="' . base_url('/admin/testimoni') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/admin/testimoni') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-like"></i>
                            <p>Testimoni</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/admin/gallery') {
                                echo '<a href="' . base_url('/admin/gallery') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/admin/gallery') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-picture"></i>
                            <p>Gallery</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($isi == base_url() . '/admin/portofolio') {
                                echo '<a href="' . base_url('/admin/portofolio') . '" class="nav-link active">';
                            } else {
                                echo '<a href="' . base_url('/admin/portofolio') . '" class="nav-link">';
                            } ?>
                            <i class="nav-icon icon-docs"></i>
                            <p>Portofolio</p>
                            </a>
                        </li>
                        <li class="nav-header" style="padding:0.5rem;"><b>Configuration</b></li>
                        <?php
                        if ($isi == base_url() . '/admin/company') {
                            echo '<li class="nav-item has-treeview menu-open">';
                        } else {
                            echo '<li class="nav-item has-treeview">';
                        } ?>
                        <?php
                        if ($isi == base_url() . '/admin/company') {
                            echo '<a href="#" class="nav-link active">';
                        } else {
                            echo '<a href="#" class="nav-link">';
                        } ?>
                        <i class="nav-icon icon-settings"></i>
                        <p>
                            Settings
                            <i class="right icon-arrow-left" style="font-size: 12px !important;margin-top: 3px !important;"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php
                                if ($isi == base_url() . '/admin/company') {
                                    echo '<a href="' . base_url('/admin/company') . '" class="nav-link active">';
                                } else {
                                    echo '<a href="' . base_url('/admin/company') . '" class="nav-link">';
                                } ?>
                                <i class="nav-icon icon-options" style="margin-left: 10px;font-size: 12px;"></i>
                                <p>Company</p>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <hr style="width: 100%;border-top: 1px solid #dee2e6;margin-top: 8px;margin-bottom: 10px;">
                        <li class="nav-item" style="padding-bottom: 50px;;">
                            <a href="<?= base_url('admin/login/logout'); ?>" class="nav-link">
                                <i class="nav-icon icon-logout"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        <!-- END MENU -->
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END SIDEBAR MENU -->

        <?= $this->renderSection('content'); ?>


        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <div class="modal fade" id="modaltambah">
        </div>

        <footer class="main-footer text-sm">
            <div class="float-right d-none d-sm-inline">
                Blaa..blaa..blaa
            </div>
            <strong>Copyright &copy;2020 <a href="https://www.instagram.com/andiiick/" target="_blank">andiiick</a>.</strong> All rights reserved.
        </footer>
        <!-- END FOOTER -->
    </div>
    <!-- END MAIN WRAPPER -->

    <!-- JQUERY -->
    <script src="<?= base_url(); ?>/admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/admin/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
    <script src="<?= base_url(); ?>/admin/plugins/summernote/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        // DATATABLES
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                ordering: false,
                language: {
                    searchPlaceholder: 'Cari...',
                    sSearch: '',
                    lengthMenu: '_MENU_',
                },
            });
        });
        // SELECT2
        $(".select2").select2();
        // SUMMERNOTE
        $('.textarea').summernote()
        // SWAL TOASTR
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
        });
    </script>

    <script>
        const API_URL = 'http://localhost:8080';
        $(document).ready(function() {
            _getLogo()
        })

        function _getLogo() {
            $.ajax({
                url: API_URL + `/admin/company/ambil_logo`,
                dataType: "json",
                success: function(response) {
                    const logo = response.logo
                    const path = `${API_URL}/img/company/${logo}`
                    document.getElementById("logo").src = path
                },
                error: function(xhr, ajaxOptions, thrownError) {

                },
            });
        }
    </script>
</body>

</html>
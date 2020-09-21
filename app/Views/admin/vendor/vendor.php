<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-emotsmile"></i> <?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Data</li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- END TITLE & BREADCRUMB -->
    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-info" onclick="btntambah()">Tambah Data</button>
                        </div>
                        <div class="card-body">
                            <div class="viewdata">
                                <div class="row">
                                    <?php if (count($vendor) > 0) {
                                        foreach ($vendor as $res) {
                                            echo "<div class='col-md-3 col-sm-6 col-12'>
                                                  <div class='card elevation-3'>
                                                  <img class='card-img-top' src='../img/vendor/$res->image' style='padding:5px;height:165px;border-bottom:2px solid #e2e2e2;'>
                                                  <div class='card-body' style='padding: 0.5rem 1rem;'>
                                                  <h4 style='height:45px;font-size:18px;'><b>$res->vendor_nm</b></h4>
                                                  <p style='height:45px;' class='card-text'></p>
                                                  </div>
                                                  <div class='card-footer text-center' style='padding:1rem;border-top:2px solid #e2e2e2;'>
                                                  <button onclick='edit($res->vendor_id)' type='button' class='btn btn-success'>Update</button>
                                                  <button onclick='hapus($res->vendor_id,\"$res->vendor_nm\")' type='button' class='btn btn-danger'>Delete</button>
                                                  </div>
                                                  </div>
                                                  </div>";
                                        }
                                    } else {
                                        echo "<div class='col-md-12'><h6 class='text-center'>Belum ada data vendor yang ditambahkan.</h6></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->
</div>
<!-- END WRAPPER -->
<script type="text/javascript">
    function btntambah() {
        $.ajax({
            url: "<?= site_url('admin/vendor/formtambah') ?>",
            success: function(response) {
                $('#modaltambah').html(response);
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }


    function btnSimpan() {
        var vendor_nm = $("#vendor_nm").val();
        var category_id = $("#category_id").val();
        var description = $("#description").val();
        var vendor_img = $("#vendor_img").val();

        if (vendor_nm == "") {
            $("#vendor_nm").focus();
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Nama vendor harus diisi.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else if (category_id == "") {
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Silahkan pilih tipe kategori.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else if (vendor_img == "") {
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Silahkan pilih logo vendor.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else {
            var ajaxData = new FormData();
            ajaxData.append('action', 'forms');
            jQuery.each($("input[name^='vendor_img")[0].files, function(i, file) {
                ajaxData.append('vendor_img[' + i + ']', file);
            });
            ajaxData.append('vendor_nm', vendor_nm);
            ajaxData.append('category_id', category_id);
            ajaxData.append('description', description);
            $.ajax({
                url: "<?= base_url('admin/vendor/simpandata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data vendor berhasil ditambahkan"
                        });
                        $('#modaltambah').modal('hide');
                        $(".viewdata").load("<?= base_url('Admin/vendor') ?> .viewdata");
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response.error
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Error !, Silahkan coba beberapa saat lagi."
                    });
                }
            });
        }
    }

    function btnupdate(id) {
        var vendor_nm = $("#vendor_nm").val();
        var category_id = $("#category_id").val();
        var description = $("#description").val();
        if (vendor_nm == "" || category_id == "") {
            Swal.fire({
                title: "Data harus di isi!!",
                text: "GAGAL!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#556ee6",
                cancelButtonColor: "#f46a6a"
            })
        } else {
            var ajaxData = new FormData();
            ajaxData.append('action', 'forms');
            jQuery.each($("input[name^='vendor_img")[0].files, function(i, file) {
                ajaxData.append('vendor_img[' + i + ']', file);
            });
            ajaxData.append('vendor_nm', vendor_nm);
            ajaxData.append('category_id', category_id);
            ajaxData.append('description', description);
            ajaxData.append('id', id);
            $.ajax({
                url: "<?= base_url('admin/vendor/updatedata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data vendor berhasil ditambahkan"
                        });
                        $('#modaltambah').modal('hide');
                        $(".viewdata").load("<?= base_url('Admin/vendor') ?> .viewdata");
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response.error
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Error !, Silahkan coba beberapa saat lagi."
                    });
                }
            });
        }
    }

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/vendor/formtambah') ?>",
            data: {
                id: id
            },
            success: function(response) {
                if (response) {
                    $('#modaltambah').html(response);
                    $('#modaltambah').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }

    function hapus(vendor_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data vendor:<p class='mt-2 mb-0'>"<b>${nama}</b>"</p>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, hapus',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/vendor/hapusdata') ?>",
                    data: {
                        vendor_id: vendor_id
                    },
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                            $(".viewdata").load("<?= base_url('Admin/vendor') ?> .viewdata");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(vendor_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/vendor/detail') ?>",
            data: {
                vendor_id: vendor_id
            },
            success: function(response) {
                $('#modaltambah').html(response);
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
</script>
<?= $this->endSection(); ?>
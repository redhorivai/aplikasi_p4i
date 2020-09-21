<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-film"></i> <?= $title; ?></h1>
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
                                    <?php if (count($slider) > 0) {
                                        foreach ($slider as $res) {
                                            $jmlTitle = strlen($res->title);
                                            if (!empty($res->title)) {
                                                if ($jmlTitle >= 40) {
                                                    $title = substr($res->title, 0, 40);
                                                    $titleTxt = $title . '...';
                                                } else {
                                                    $titleTxt = $res->title;
                                                }
                                            } else {
                                                $titleTxt = "Untitled";
                                            }
                                            $jmlSubTitle = strlen($res->sub_title);
                                            if (!empty($res->sub_title)) {
                                                if ($jmlSubTitle >= 65) {
                                                    $subTitle = substr($res->sub_title, 0, 65);
                                                    $subTitleTxt = $subTitle . '...';
                                                } else {
                                                    $subTitleTxt = $res->sub_title;
                                                }
                                            } else {
                                                $subTitleTxt = "-";
                                            }
                                            echo "<div class='col-md-3 col-sm-6 col-12'>
                                                  <div class='card elevation-3'>
                                                  <img class='card-img-top' src='../img/slider/$res->slider_img' style='padding:5px;height:165px;border-bottom:2px solid #e2e2e2;'>
                                                  <div class='card-body' style='padding: 0.5rem 1rem;'>
                                                  <h4 style='height:45px;font-size:18px;'><b>$titleTxt</b></h4>
                                                  <p style='height:45px;' class='card-text'>$subTitleTxt</p>
                                                  </div>
                                                  <div class='card-footer text-center' style='padding:1rem;border-top:2px solid #e2e2e2;'>
                                                  <button onclick='edit($res->slider_id)' type='button' class='btn btn-success'>Update</button>
                                                  <button onclick='hapus($res->slider_id,\"$res->title\")' type='button' class='btn btn-danger'>Delete</button>
                                                  </div>
                                                  </div>
                                                  </div>";
                                        }
                                    } else {
                                        echo "<div class='col-md-12'><h6 class='text-center'>Belum ada data slider yang ditambahkan.</h6></div>";
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
            url: "<?= site_url('admin/slider/formtambah') ?>",
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
        var title = $("#title").val();
        var sub_title = $("#sub_title").val();
        var slider_img = $("#slider_img").val();

        if (slider_img == "") {
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Silahkan pilih gambar slider.`,
                icon: 'warning',
                showConfirmButton: true,
            })
        } else {
            var ajaxData = new FormData();
            ajaxData.append('action', 'forms');
            jQuery.each($("input[name='slider_img'")[0].files, function(i, file) {
                ajaxData.append('slider_img[' + i + ']', file);
            });
            ajaxData.append('title', title);
            ajaxData.append('sub_title', sub_title);
            $.ajax({
                url: "<?= base_url('admin/slider/simpandata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data slider berhasil ditambahkan"
                        });
                        $('#modaltambah').modal('hide');
                        $(".viewdata").load("<?= base_url('Admin/slider') ?> .viewdata");
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response
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
        var title = $("#title").val();
        var sub_title = $("#sub_title").val();
        var slider_img = $("#slider_img").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        if (slider_img == "") {
            var slider_img2 = $("#slider_img2").val();
            ajaxData.append('slider_img2', slider_img2);
        } else {
            jQuery.each($("input[name='slider_img'")[0].files, function(i, file) {
                ajaxData.append('slider_img[' + i + ']', file);
            });
        }

        ajaxData.append('title', title);
        ajaxData.append('sub_title', sub_title);
        ajaxData.append('slider_id', id);

        $.ajax({
            url: "<?= base_url('admin/slider/updatedata'); ?>",
            type: "POST",
            data: ajaxData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data slider telah diperbaharui."
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $("#modaltambah").modal('hide');
                $(".viewdata").load("<?= base_url('Admin/slider') ?> .viewdata");
            },
            error: function() {
                Toast.fire({
                    icon: "error",
                    title: "Error !, Silahkan coba beberapa saat lagi."
                });
            }
        });
    }

    function edit(slider_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/slider/formtambah') ?>",
            data: {
                slider_id: slider_id
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

    function hapus(slider_id, nama) {
        if (nama === "") {
            var nama = 'Untitled';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data slider:<p class='mt-2 mb-0'>"<b>${nama}</b>"</p>`,
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
                    url: "<?= site_url('admin/slider/hapusdata') ?>",
                    data: {
                        slider_id: slider_id
                    },
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: `Data slider&nbsp;<b class='text-danger'>${nama}</b>&nbsp;telah dihapus.`,
                            });
                            $(".viewdata").load("<?= base_url('Admin/slider') ?> .viewdata");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(slider_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/slider/detail') ?>",
            data: {
                slider_id: slider_id
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
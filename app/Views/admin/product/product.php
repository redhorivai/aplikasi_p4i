<?php

use App\Models\Productmodel;
?>
<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-bag"></i> <?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Admin/dashboard'); ?>">Dashboard</a></li>
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
                        <div class="card-body viewdata">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width='10' class="text-center">No.</th>
                                        <th>Product</th>
                                        <th width="100">Status</th>
                                        <th width='50' class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($product as $res) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?>.</td>
                                            <td>
                                                <div class="product-info">
                                                    <a href="javascript:void(0)" class="product-title" onclick="edit('<?= $res->product_id; ?>')"><?= $res->product_nm; ?></a>
                                                    <span class="product-description text-dark">
                                                        <p class="mb-0" style="font-size: 80%;"><b style="margin-right: 30px;">Code</b> <?= strtoupper($res->product_cd); ?></p>
                                                        <p class="mb-0" style="font-size: 80%;margin-bottom: 0"><b style="margin-right: 9px;">product</b> <span class="badge bg-info" style="padding:4px;"><?= $res->product_nm; ?></span></p>
                                                    </span>
                                                </div>
                                            </td>
                                            <td width="100" style="word-wrap:break-word;">
                                                <?= $res->status_cd ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                                                    <i class="icon-options"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res->product_id; ?>')">
                                                        <i class="icon-note mr-2"></i> Update
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res->product_id; ?>','<?= $res->product_nm; ?>')">
                                                        <i class="icon-close mr-2"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
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
        window.location.href = "<?= base_url() ?>/Admin/product/formtambah";
    }


    function btnSimpan() {
        var product_nm = $("#product_nm").val();
        var product_cd = $("#product_cd").val();
        var category_id = $("#category_id").val();
        var description = $("#description").val();
        var vendor_id = $("#vendor_id").val();

        if (product_nm == "" || product_cd == "" || category_id == "" || description == "") {
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
            jQuery.each($("input[name^='product_img")[0].files, function(i, file) {
                ajaxData.append('product_img[' + i + ']', file);
            });
            ajaxData.append('product_nm', product_nm);
            ajaxData.append('product_cd', product_cd);
            ajaxData.append('category_id', category_id);
            ajaxData.append('description', description);
            ajaxData.append('vendor_id', vendor_id);
            $.ajax({
                url: "<?= base_url('admin/product/simpandata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data product berhasil ditambahkan"
                        });
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response.error
                        });
                    }
                    $('#modaltambah').modal('hide');
                    $("#myTable").load("<?= base_url('Admin/product') ?> #myTable");
                },
                error: function() {
                    Toast.fire({
                        icon: "warning",
                        title: "Error, Coba lagi!!"
                    });
                }
            });
        }
    }

    function btnupdate(id) {
        var product_nm = $("#product_nm").val();
        var product_cd = $("#product_cd").val();
        var category_id = $("#category_id").val();
        var description = $("#description").val();
        var vendor_id = $("#vendor_id").val();

        if (product_nm == "" || product_cd == "" || category_id == "" || description == "" || vendor_id == "") {
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
            jQuery.each($("input[name^='product_img")[0].files, function(i, file) {
                ajaxData.append('product_img[' + i + ']', file);
            });
            ajaxData.append('product_nm', product_nm);
            ajaxData.append('product_cd', product_cd);
            ajaxData.append('category_id', category_id);
            ajaxData.append('description', description);
            ajaxData.append('id', id);
            ajaxData.append('vendor_id', vendor_id);
            $.ajax({
                url: "<?= base_url('admin/product/updatedata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    alert(response);
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data product berhasil ditambahkan"
                        });
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response.error
                        });
                    }
                    $('#modaltambah').modal('hide');
                    $("#myTable").load("<?= base_url('admin/product') ?> #myTable");
                },
                error: function() {
                    Toast.fire({
                        icon: "warning",
                        title: "Error, Coba lagi!!"
                    });
                }
            });
        }
    }

    function edit(id) {
        window.location.href = "<?= base_url() ?>/admin/product/formtambah/" + id;
    }

    function hapus(product_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data product:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/product/hapusdata') ?>",
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                            $("#myTable").load("<?= base_url('admin/product') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(product_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/product/detail') ?>",
            data: {
                product_id: product_id
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
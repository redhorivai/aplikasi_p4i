<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-star"></i> <?= $title; ?></h1>
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
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width='10' class="text-center">No.</th>
                                        <th>Kategori</th>
                                        <th>Tipe</th>
                                        <th width='50' class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($category as $res) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?>.</td>
                                            <td><?= $res->category_nm; ?></td>
                                            <td><?= $res->type; ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                                                    <i class="icon-options"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res->category_id; ?>')">
                                                        <i class="icon-note mr-2"></i> Update
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res->category_id; ?>','<?= $res->category_nm; ?>')">
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
<script type="text/javascript">
    function btntambah() {
        $.ajax({
            url: "<?= site_url('admin/category/form') ?>",
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
        var category_nm = $("#category_nm").val();
        var type = $("#type").val();

        if (category_nm == "") {
            $("#category_nm").focus();
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Nama kategori harus diisi.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else if (type == "") {
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Silahkan pilih tipe kategori.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else {
            $.ajax({
                url: "<?= base_url('admin/category/simpandata'); ?>",
                type: "POST",
                data: {
                    category_nm: category_nm,
                    type: type
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data kategori berhasil ditambahkan"
                        });
                        $('#modaltambah').modal('hide');
                        $("#myTable").load("<?= base_url('Admin/category') ?> #myTable");
                    } else {
                        Swal.fire({
                            title: 'Pemberitahuan',
                            html: response,
                            icon: 'warning',
                            showConfirmButton: true,
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
            url: "<?= site_url('admin/category/form') ?>",
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

    function btnupdate(id) {
        var category_nm = $("#category_nm").val();
        var type = $("#type").val();

        if (category_nm == "") {
            $("#category_nm").focus();
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Nama kategori harus diisi.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else if (type == "") {
            Swal.fire({
                title: 'Pemberitahuan',
                html: `Silahkan pilih tipe kategori.`,
                icon: 'warning',
                showConfirmButton: true,
            });
        } else {
            $.ajax({
                url: "<?= base_url('admin/category/updatedata'); ?>",
                type: "POST",
                data: {
                    category_nm: category_nm,
                    type: type,
                    id: id
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data kategori telah diperbaharui."
                        });
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response
                        });
                    }
                    $('#modaltambah').modal('hide');
                    $("#myTable").load("<?= base_url('Admin/category') ?> #myTable");
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

    function hapus(category_id, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data kategori:<p class='mt-2 mb-0'>"<b>${nama}</b>"</p>`,
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
                    url: "<?= site_url('admin/category/hapusdata') ?>",
                    data: {
                        category_id: category_id
                    },
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                            $("#myTable").load("<?= base_url('Admin/category') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(category_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/category/detail') ?>",
            data: {
                category_id: category_id
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
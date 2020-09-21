<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>

<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-note"></i> <?= $title; ?></h1>
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
                        <div class="card-body" id="viewdata">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width='10' class="text-center">No.</th>
                                        <th>Article Title </th>
                                        <th>artikel</th>
                                        <th width='50' class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($artikel as $res) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?>.</td>
                                            <td><?= $res->artikel_nm ?></td>
                                            <td><?= $res->description ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                                                    <i class="icon-options"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res->artikel_id ?>')">
                                                        <i class="icon-note mr-2"></i> Update
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res->artikel_id ?>','<?= $res->artikel_nm ?>')">
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
        window.location.href = "<?= base_url() ?>/Admin/artikel/formtambah";
    }

    function edit(id) {
        window.location.href = "<?= base_url() ?>/Admin/artikel/formtambah/" + id;
    }

    function hapus(artikel_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data artikel:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/artikel/hapusdata') ?>",
                    data: {
                        artikel_id: artikel_id
                    },
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                            $("#myTable").load("<?= base_url('Admin/artikel') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function detail(artikel_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/artikel/detail') ?>",
            data: {
                artikel_id: artikel_id
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
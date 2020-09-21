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
                                    <th>Testimoni</th>
                                    <th>Description</th>
                                    <th width='50' class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($testimoni as $res) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?>.</td>
                                        <td class="text-center"><?= $res->nama ?></td>
                                        <td>
                                            <?php
                                            if (empty($res->isi)) {
                                                echo '<em>No description posted yet.</em>';
                                            } else {
                                                echo '' . $res->isi . '';
                                            }
                                            ?>
                                        </td>
                                        <td width="200" class="text-center">
                                            <?php 
                                            if ($res->status_cd == "normal") {
                                                echo "<button onclick='approved($res->testimoni_id)' class='btn btn-success'><i class='fa fa-thumbs-up'></i></button> ";
                                                echo "<button onclick='rejected($res->testimoni_id)' class='btn btn-danger'><i class='fa fa-thumbs-down'></i></button> ";
                                            } else if ($res->status_cd == "approved") {
                                                echo "<span><i class='fa fa-check'></i></span>";
                                            } else if ($res->status_cd == "rejected") {
                                                echo "<span><i class='icon-close'></i></span>";
                                            }


                                             ?>
                                            <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                                                <i class="icon-options"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res->testimoni_id; ?>')">
                                                    <i class="icon-note mr-2"></i> Update
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res->testimoni_id; ?>','<?= $res->nama; ?>')">
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
function btntambah(){
    $.ajax({
        url: "<?= site_url('admin/testimoni/formtambah') ?>",
        success: function(response) {
            $('#modaltambah').html(response);
            $('#modaltambah').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}


function btnSimpan(){
     var nama = $("#nama").val();
     var email = $("#email").val();
     var description = $("#description").val();

        if (nama =="" || email == "" || description == "") {
            Swal.fire({
            title:"Data harus di isi!!",
            text:"GAGAL!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#556ee6",
            cancelButtonColor:"#f46a6a"
                })
        } else {
             var ajaxData = new FormData();
             ajaxData.append('action','forms');
             ajaxData.append('nama',nama);
             ajaxData.append('email',email);
             ajaxData.append('description',description);
            $.ajax({
                url: "<?= base_url('admin/testimoni/simpandata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data testimoni berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response.error
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#myTable" ).load("<?= base_url('admin/testimoni') ?> #myTable");
            },
            error:function(){
                Toast.fire({
                    icon: "warning",
                    title: "Error, Coba lagi!!"
                });
            }
            });
        }
}

function btnupdate(id){
     var nama = $("#nama").val();
     var email = $("#email").val();
     var description = $("#description").val();

        if (nama =="" || email == "" || description == "" || id == "") {
            Swal.fire({
            title:"Data harus di isi!!",
            text:"GAGAL!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#556ee6",
            cancelButtonColor:"#f46a6a"
                })
        } else {
             var ajaxData = new FormData();
             ajaxData.append('action','forms');
             ajaxData.append('nama',nama);
             ajaxData.append('email',email);
             ajaxData.append('description',description);
             ajaxData.append('id',id);
            $.ajax({
                url: "<?= base_url('admin/testimoni/updatedata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data testimoni berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response.error
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#myTable" ).load("<?= base_url('admin/testimoni') ?> #myTable");
            },
            error:function(){
                Toast.fire({
                    icon: "warning",
                    title: "Error, Coba lagi!!"
                });
            }
            });
        }
}

function approved(id) {
    $.ajax({
        type: "post",
        url: "<?= site_url('admin/testimoni/approved') ?>",
        data: {id:id},
        success: function(response) {
            $( "#myTable" ).load("<?= base_url('admin/testimoni') ?> #myTable");
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

function rejected(id) {
    $.ajax({
        type: "post",
        url: "<?= site_url('admin/testimoni/rejected') ?>",
        data: {id:id},
        success: function(response) {
            $( "#myTable" ).load("<?= base_url('admin/testimoni') ?> #myTable");
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/testimoni/formtambah') ?>",
            data: {id:id},
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

    function hapus(testimoni_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data testimoni:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/testimoni/hapusdata') ?>",
                    data: {testimoni_id: testimoni_id},
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                $("#myTable").load("<?= base_url('admin/testimoni') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

function detail(testimoni_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/testimoni/detail') ?>",
            data: {testimoni_id: testimoni_id},
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
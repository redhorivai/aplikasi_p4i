<?= $this->extend('admin/layout/template'); ?>
    <?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-people"></i> <?= $title; ?></h1>
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
            <th>User</th>
            <th width='50' class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($user as $res) : ?>
            <tr>
                <td class="text-center"><?= $no++; ?>.</td>
                <td>
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li class="item" style="background: transparent;padding: 0;">
                            <div class="product-img" style="margin-top: 5px;">
                                <a href="javascript:void(0)" onclick="detail('<?= $res->user_id; ?>')">
                                    <?php
                                    if (empty($res->avatar) && $res->gender == 'L') {
                                        echo '<img src="' . base_url() . '/img/user/avatar.png" class="img-circle img-size-50">';
                                    } else if (empty($res->avatar) && $res->gender == 'P') {
                                        echo '<img src="' . base_url() . '/img/user/avatar3.png" class="img-circle img-size-50">';
                                    } else if (!empty($res->avatar)) {
                                        echo '<img src="' . base_url() . '/img/user/' . $res->avatar . '" class="img-circle img-size-50">';
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title" onclick="detail('<?= $res->user_id; ?>')"><?= $res->name; ?></a>
                                <span class="product-description text-dark">
                                    <p style="font-size: 80%;margin-bottom: 0"><b style="margin-right: 23px;">Username</b> <?= $res->username; ?></p>
                                    <p style="font-size: 80%;margin-bottom: 0"><b style="margin-right: 15px;">Level Akses</b>
                                        <?php
                                        if ($res->level == 1) {
                                            echo 'Super User';
                                        } else if ($res->level == 2) {
                                            echo 'Admin';
                                        } else if ($res->level == 3) {
                                            echo 'User';
                                        }
                                        ?>
                                    </p>
                                    <p style="font-size: 80%;margin-bottom: 0">
                                        <?php
                                        if ($res->status_acc == 'active') {
                                            echo '<span class="badge bg-success" style="padding:4px;">Active</span>';
                                        } else {
                                            echo '<span class="badge bg-danger" style="padding:4px;">Deactive</span>';
                                        }
                                        ?>
                                    </p>
                                </span>
                            </div>
                        </li>
                    </ul>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light" data-toggle="dropdown" href="#">
                        <i class="icon-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item" onclick="edit('<?= $res->user_id; ?>')">
                            <i class="icon-note mr-2"></i> Update
                        </a>
                        <?php if ($res->status_acc == 'active') { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="deactive('<?= $res->user_id; ?>','<?= $res->name; ?>')">
                                <i class="icon-user-unfollow mr-2"></i> Deactive
                            </a>
                        <?php } ?>
                        <?php if ($res->status_acc == 'deactive') { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="active('<?= $res->user_id; ?>','<?= $res->name; ?>')">
                                <i class="icon-user-following mr-2"></i> Active
                            </a>
                        <?php } ?>
                        <?php if (session()->get('user_id') != $res->user_id) { ?>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)" class="dropdown-item" onclick="hapus('<?= $res->user_id; ?>','<?= $res->name; ?>')">
                                <i class="icon-close mr-2"></i> Delete
                            </a>
                        <?php } ?>
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
        url: "<?= site_url('admin/user/formtambah') ?>",
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
     var username   = $("#username").val();
     var name       = $("#name").val();
     var gender     = $("#gender").val();
     var level      = $("#level").val();
     var password   = $("#password").val();
     var jabatan    = $("#jabatan").val();
     var facebook   = $("#facebook").val();
     var instagram  = $("#instagram").val();
     var twitter    = $("#twitter").val();
     var email      = $("#email").val();
     var cellphone  = $("#cellphone").val();
     var avatar     = $('#avatar')[0].files[0];
        if (username =="" || name == "" || gender == "" || level == "") {
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
            ajaxData.append('username',username);
            ajaxData.append('name',name);
            ajaxData.append('gender',gender);
            ajaxData.append('level',level);
            ajaxData.append('password',password);
            ajaxData.append('jabatan',jabatan);
            ajaxData.append('facebook',facebook);
            ajaxData.append('instagram',instagram);
            ajaxData.append('twitter',twitter);
            ajaxData.append('email',email);
            ajaxData.append('cellphone',cellphone);
            ajaxData.append('avatar',avatar);
            $.ajax({
                url: "<?= base_url('admin/user/simpandata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data user berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#myTable" ).load("<?= base_url('admin/user') ?> #myTable");
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
     var username   = $("#username").val();
     var name       = $("#name").val();
     var gender     = $("#gender").val();
     var level      = $("#level").val();
     var jabatan    = $("#jabatan").val();
     var facebook   = $("#facebook").val();
     var instagram  = $("#instagram").val();
     var twitter    = $("#twitter").val();
     var email      = $("#email").val();
     var cellphone  = $("#cellphone").val();
     var avatar     = $('#avatar')[0].files[0];

        if (username =="" || name == "" || gender == "" || level == "") {
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
            ajaxData.append('username',username);
            ajaxData.append('name',name);
            ajaxData.append('gender',gender);
            ajaxData.append('level',level);
            ajaxData.append('password',password);
            ajaxData.append('jabatan',jabatan);
            ajaxData.append('facebook',facebook);
            ajaxData.append('instagram',instagram);
            ajaxData.append('twitter',twitter);
            ajaxData.append('email',email);
            ajaxData.append('cellphone',cellphone);
            ajaxData.append('avatar',avatar);
            ajaxData.append('id',id);

            $.ajax({
                url: "<?= base_url('admin/user/updatedata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data user berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#myTable" ).load("<?= base_url('admin/user') ?> #myTable");
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

function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/user/formtambah') ?>",
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

    function hapus(user_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data user:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/user/hapusdata') ?>",
                    data: {user_id: user_id},
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                $("#myTable").load("<?= base_url('admin/user') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

function detail(user_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/user/detail') ?>",
            data: {user_id: user_id},
            success: function(response) {
                $('#modaltambah').html(response);
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }

    function deactive(user_id, nama) {
        Swal.fire({
            title: 'Nonaktif Akun?',
            html: `Anda akan menonaktifkan akun user:<br> <b>${nama}</b>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/user/deactive') ?>",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                            $("#myTable").load("<?= base_url('admin/user') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

    function active(user_id, nama) {
        Swal.fire({
            title: 'Aktivasi Akun?',
            html: `Anda akan mengaktifkan akun user:<br> <b>${nama}</b>`,
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            cancelButtonText: 'Tidak, batalkan',
            confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/user/active') ?>",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                                icon: "success",
                                title: response.sukses,
                            });
                        $("#myTable").load("<?= base_url('admin/user') ?> #myTable");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }
</script>
<?= $this->endSection(); ?>

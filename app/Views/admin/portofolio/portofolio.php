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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
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
            <div class="row el-element-overlay">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-info" onclick="btntambah()">Tambah Data</button>
                        </div>
                        <div class="card-body" id="viewdata">
                        <?= $portofolio ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->
    <div id="myModal" class="modal-portofolio">
	</div>
</div>


<!-- END WRAPPER -->
<script type="text/javascript">
function btntambah(){
   window.location.href = "<?=base_url()?>/admin/portofolio/formtambah/";
}

function showslide(id) {
	$.ajax({
        url: "<?= site_url('admin/portofolio/showslide') ?>",
        type: "POST",
        data: {id:id},
        success: function(response) {
            $('#myModal').html(response);
            $('#myModal').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}


function btnSimpan(){
     var portofolio_nm = $("#portofolio_nm").val();
     var category_id = $("#category_id").val();
     var portofolio_img = $("#portofolio_img").val();

        if (portofolio_nm =="" || category_id == "" || portofolio_img == "") {
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
             jQuery.each($("input[name^='portofolio_img'")[0].files, function(i, file) {
                ajaxData.append('portofolio_img['+i+']', file);
              });
             ajaxData.append('portofolio_nm',portofolio_nm);
             ajaxData.append('category_id',category_id);
            $.ajax({
                url: "<?= base_url('admin/portofolio/simpandata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data portofolio berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#viewdata" ).load("<?= base_url('admin/portofolio') ?> #viewdata");
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
     var title = $("#title").val();
     var sub_title = $("#sub_title").val();
     var portofolio_img = $("#portofolio_img").val();
        if (title == "" || sub_title == "") {
            Swal.fire({
            title:"Title harus di isi!!",
            text:"GAGAL!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#556ee6",
            cancelButtonColor:"#f46a6a"
            })
        } else {
             var ajaxData = new FormData();
              ajaxData.append('action','forms');
             if (portofolio_img == "") {
              var portofolio_img2 = $("#portofolio_img2").val();
              ajaxData.append('portofolio_img2',portofolio_img2);
             } else {
              jQuery.each($("input[name^='portofolio_img'")[0].files, function(i, file) {
                ajaxData.append('portofolio_img['+i+']', file);
              });
             }

             ajaxData.append('title',title);
             ajaxData.append('sub_title',sub_title);
             ajaxData.append('portofolio_id',id);

            $.ajax({
                url: "<?= base_url('admin/portofolio/updatedata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data portofolio berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $("#modaltambah").modal('hide');
                $("#viewdata").load("<?= base_url('admin/portofolio') ?> #viewdata");
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
  window.location.href = "<?=base_url()?>/admin/portofolio/formtambah/"+id;
}

function editx(portofolio_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/portofolio/formtambah') ?>",
            data: {portofolio_id: portofolio_id},
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

    function hapus(portofolio_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data portofolio:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/portofolio/hapusdata') ?>",
                    data: {portofolio_id: portofolio_id},
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                $("#viewdata").load("<?= base_url('admin/portofolio') ?> #viewdata");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

function detail(portofolio_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/portofolio/detail') ?>",
            data: {portofolio_id: portofolio_id},
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

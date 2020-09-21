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
                        <?= $gallery ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->
    <div id="myModal" class="modal-gallery">
	</div>
</div>


<!-- END WRAPPER -->
<script type="text/javascript">
function btntambah(){
   window.location.href = "<?=base_url()?>/admin/gallery/formtambah/";
}

function showslide(id) {
	$.ajax({
        url: "<?= site_url('admin/gallery/showslide') ?>",
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
     var gallery_nm = $("#gallery_nm").val();
     var category_id = $("#category_id").val();
     var gallery_img = $("#gallery_img").val();

        if (gallery_nm =="" || category_id == "" || gallery_img == "") {
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
             jQuery.each($("input[name^='gallery_img'")[0].files, function(i, file) {
                ajaxData.append('gallery_img['+i+']', file);
              });
             ajaxData.append('gallery_nm',gallery_nm);
             ajaxData.append('category_id',category_id);
            $.ajax({
                url: "<?= base_url('admin/gallery/simpandata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data gallery berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $('#modaltambah').modal('hide');
                $( "#viewdata" ).load("<?= base_url('admin/gallery') ?> #viewdata");
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
     var gallery_img = $("#gallery_img").val();
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
             if (gallery_img == "") {
              var gallery_img2 = $("#gallery_img2").val();
              ajaxData.append('gallery_img2',gallery_img2);
             } else {
              jQuery.each($("input[name^='gallery_img'")[0].files, function(i, file) {
                ajaxData.append('gallery_img['+i+']', file);
              });
             }

             ajaxData.append('title',title);
             ajaxData.append('sub_title',sub_title);
             ajaxData.append('gallery_id',id);

            $.ajax({
                url: "<?= base_url('admin/gallery/updatedata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data gallery berhasil ditambahkan"
                    });
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
                $("#modaltambah").modal('hide');
                $("#viewdata").load("<?= base_url('admin/gallery') ?> #viewdata");
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
  window.location.href = "<?=base_url()?>/admin/gallery/formtambah/"+id;
}

function editx(gallery_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/gallery/formtambah') ?>",
            data: {gallery_id: gallery_id},
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

    function hapus(gallery_id, nama) {
        if (nama === "") {
            var nama = 'No Title';
        } else {
            var nama = nama;
        }
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus data gallery:<br> <b>${nama}</b>`,
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
                    url: "<?= site_url('admin/gallery/hapusdata') ?>",
                    data: {gallery_id: gallery_id},
                    success: function(response) {
                        if (response == "Sukses") {
                            Toast.fire({
                                icon: "success",
                                title: response,
                            });
                $("#viewdata").load("<?= base_url('admin/gallery') ?> #viewdata");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    },
                });
            }
        });
    }

function detail(gallery_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/gallery/detail') ?>",
            data: {gallery_id: gallery_id},
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

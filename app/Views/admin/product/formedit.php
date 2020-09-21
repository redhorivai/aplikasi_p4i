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
                        <div class="card-body" id="viewdata">
                            <form class="forms" id="forms" action="post" enctype="multipart/form-data">
                              <?php
                              foreach ($product as $key) {
                              ?>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Code: <b class="text-danger">*</b></label>
                                            <input type="text" name="product_cd" id="product_cd" class="form-control" placeholder="Product Code" style="text-transform: capitalize;" value="<?= $key->product_cd ?>">
                                            <div class="invalid-feedback errorCode"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name: <b class="text-danger">*</b></label>
                                            <input type="text" name="product_nm" id="product_nm" class="form-control" placeholder="Product Name" style="text-transform: capitalize;" value="<?= $key->product_nm ?>">
                                            <div class="invalid-feedback errorName"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Category: <b class="text-danger">*</b></label>
                                            <select class="form-control select2" name="category_id" id="category_id" data-placeholder="-- Select Category --" data-allow-clear="true" style="width:100%;">
                                            <option value=""></option>
                                            <?php 
                                            foreach ($category as $res) {
                                                echo "<option ".($key->category_id==$res->category_id?"selected='selected'":"")." value='$res->category_id'>$res->category_nm</option>";
                                                }
                                            ?>
                                            </select>
                                                <div class="invalid-feedback errorCategory"></div>
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Product Price: <b class="text-danger">*</b></label>
                                                <input type="text" name="price1" id="price1" class="form-control" placeholder="Rp 30.000.000" style="text-transform: capitalize;" value="<?= $key->price1 ?>">
                                                <div class="invalid-feedback errorName"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price Discount: <b class="text-danger">*</b></label>
                                                <input type="text" name="price2" id="price2" class="form-control" placeholder="Rp 10.000.000" style="text-transform: capitalize;" value="<?= $key->price2 ?>">
                                                <div class="invalid-feedback errorName"></div>
                                            </div>
                                        </div>
                            </div>
                            <div class="row">
                              <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Thumbnail :</label><br>
                                            <div class="row text-center">
                                                <div class="col-sm-12 col-12">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;border-radius: 5px;">
                                                                <img src="<?= base_url()?>/img/thumbnail/<?= $key->thumbnail ?>">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;"></div>
                                                                <div>
                                                                    <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                        <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                            <span class="fileinput-exists mr-1">Change</span>
                                                                            <input type="file" name="thumbnail" id="thumbnail"/>
                                                                        </span>
                                                                        <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                                                                </div>
                                                                <small class="errorImg" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5" style="border-left: 1px solid #000">
                                        <div class="form-group">
                                            <label>Product Image:</label><br>
                                            <div class="row text-center">
                                                <div class="col-sm-12 col-12">
                                                    <div id="div-img" class="fileinput fileinput-new" data-provides="fileinput">
                                                            
                        <?php
                            $i = 1;
                          foreach ($images as $img) {
                                echo "<div onclick='openModal();currentSlide($i)' class='fileinput-new thumbnail hover-shadow cursor' style='width:165px;height:175px;border:2px solid #e2e2e2;border-radius: 5px; position:relative;'>
                                        <img src='".base_url()."/img/product/$img->images_nm'>
                                        <input type='hidden' value='$img->images_nm' name='imag2[]'/>
                                        <button type='button' onclick='removeimg($img->images_id)' style='position:absolute; top:0; left:0;' class='btn btn-circle btn-success'><i class='fa fa-times'></i></button>
                                        </div>";
                            if ($i != $current) {
                                $i++;
                            }
                          }
                        ?>
                                                                
                                                            
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;"></div>
                                                                <div>
                                                                    <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                        <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                            <span class="fileinput-exists mr-1">Change</span>
                                                                            <input type="file" name="product_img[]" id="product_img[]" multiple="" />
                                                                        </span>
                                                                        <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                                                                </div>
                                                                <small class="errorImg" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                              <div class="form-group col-md-12">
                                <label for="artikel_nm">Description</label>
                              <div class="card card-outline card-info">
                                <!-- /.card-header -->
                                <div class="card-body pad">
                                  <div class="mb-3">
                                    <textarea class="textarea" name="description" id="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $key->description?></textarea>
                                  </div>
                                </div>
                              </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="row w-50">
                                    <div class="col-sm-6">
                                        <button onclick="btnupdate(<?= $key->product_id ?>)" type="button" class="btn btn-block btn-primary mb-2 btnSimpan">Simpan</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-block btn-outline-secondary mb-2" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </form>
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
  window.location.href = "<?=base_url()?>/admin/product/formtambah";
}

function btnupdate(id){
     var product_nm = $("#product_nm").val();
     var product_cd = $("#product_cd").val();
     var category_id = $("#category_id").val();
     var description = $("#description").val();
     var thumbnail = $('#thumbnail')[0].files[0];

        if (product_nm == "" || product_cd == "" || category_id == "") {
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
              jQuery.each($("input[name^='product_img")[0].files, function(i, file) {
                ajaxData.append('product_img['+i+']', file);
              })
              ajaxData.append('product_nm',product_nm);
              ajaxData.append('product_cd',product_cd);
              ajaxData.append('category_id',category_id);
              ajaxData.append('description',description);
              ajaxData.append('thumbnail',thumbnail);
              ajaxData.append('price1',price1);
              ajaxData.append('price2',price2);
              ajaxData.append('id',id);
            $.ajax({
                url: "<?= base_url('admin/product/updatedata'); ?>",
                type: "POST",
                data : ajaxData,
                contentType: false,
                processData: false,
            success:function(response){
                if (response == "Sukses") {
                    Toast.fire({
                        icon: "success",
                        title: "Data product berhasil ditambahkan"
                    });
            window.location.href = "<?=base_url()?>/admin/product";
                } else {
                    Toast.fire({
                        icon: "warning",
                        title: response
                    });
                }
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

function removeimg(id) {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Anda akan menghapus gambar`,
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
                url: "<?= site_url('admin/product/hapusimg') ?>",
                data: {id:id},
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: response,
                        });
                    $("#div-img").load("<?= current_url(true); ?> #div-img");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }
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


</script>
<?= $this->endSection(); ?>



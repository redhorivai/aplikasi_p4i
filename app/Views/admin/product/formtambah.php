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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Code: <b class="text-danger">*</b></label>
                                            <input type="text" name="product_cd" id="product_cd" class="form-control" placeholder="Product Code" style="text-transform: capitalize;">
                                            <div class="invalid-feedback errorCode"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name: <b class="text-danger">*</b></label>
                                            <input type="text" name="product_nm" id="product_nm" class="form-control" placeholder="Product Name" style="text-transform: capitalize;">
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
                                                echo "<option value='$res->category_id'>$res->category_nm</option>";
                                                }
                                            ?>
                                            </select>
                                                <div class="invalid-feedback errorCategory"></div>
                                        </div>

                                        <div class="col-md-6">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Product Price: <b class="text-danger">*</b></label>
                                                <input type="text" name="price1" id="price1" class="form-control" placeholder="Rp 30.000.000" style="text-transform: capitalize;">
                                                <div class="invalid-feedback errorName"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price Discount: <b class="text-danger">*</b></label>
                                                <input type="text" name="price2" id="price2" class="form-control" placeholder="Rp 10.000.000" style="text-transform: capitalize;">
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
                                                                <img src="<?= base_url()?>/img/product/no_image.png">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;"></div>
                                                                <div>
                                                                    <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                        <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                            <span class="fileinput-exists mr-1">Change</span>
                                                                            <input type="file" name="thumbnail" id="thumbnail" required="" />
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
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;border-radius: 5px;">
                                                                <img src="<?= base_url()?>/img/product/no_image.png">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;"></div>
                                                                <div>
                                                                    <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                        <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                            <span class="fileinput-exists mr-1">Change</span>
                                                                            <input type="file" name="product_img[]" id="product_img[]" multiple=""  required="" />
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
                                        <textarea class="textarea" name="description" id="description" placeholder="Place some text here"
                                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                </div>

                                <div class="row">
                                    <div class="row w-50">
                                        <div class="col-sm-6">
                                            <button onclick="btnSimpan()" type="button" class="btn btn-block btn-primary mb-2 btnSimpan">Simpan</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-block btn-outline-secondary mb-2" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
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


function btnSimpan(){
     var product_nm = $("#product_nm").val();
     var product_cd = $("#product_cd").val();
     var category_id = $("#category_id").val();
     var description = $("#description").val();
     var price1 = $("#price1").val();
     var price2 = $("#price2").val();
     var thumbnail = $('#thumbnail')[0].files[0];


        if (product_nm =="" || category_id == "" ||  price1 == "") {
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
                });
             ajaxData.append('product_nm',product_nm);
             ajaxData.append('product_cd',product_cd);
             ajaxData.append('category_id',category_id);
             ajaxData.append('description',description);
             ajaxData.append('thumbnail',thumbnail);
             ajaxData.append('price1',price1);
             ajaxData.append('price2',price2);
             ajaxData.append('thumb',price2);
            $.ajax({
                url: "<?= base_url('admin/product/simpandata'); ?>",
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
        
</script>
<?= $this->endSection(); ?>

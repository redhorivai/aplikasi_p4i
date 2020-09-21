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
                        <li class="breadcrumb-item"><a href="<?= base_url('Admin/artikel'); ?>">Artikel</a></li>
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
                                foreach ($artikel as $key) {

                                ?>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="artikel_nm">Judul Artikel</label>
                                            <input type="text" class="form-control" name="artikel_nm" id="artikel_nm" value="<?= $key->artikel_nm ?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="artikel_nm">Judul Artikel</label>
                                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                                <option> -- Choose Category -- </option>
                                                <?php
                                                foreach ($cate as $k) {
                                                    echo "<option " . ($key->category_id == $k->category_id ? "selected='selected'" : "") . " value='$k->category_id'>$k->category_nm</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Artikel Image:</label><br>
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-12">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;border-radius: 5px;">
                                                                <img src="<?= base_url() ?>/img/artikel/<?= $key->artikel_img ?>">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:165px;height:175px;border:2px solid #e2e2e2;"></div>
                                                            <div>
                                                                <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                    <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                    <span class="fileinput-exists mr-1">Change</span>
                                                                    <input type="file" name="artikel_img" id="artikel_img" multiple="" />
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
                                                        <textarea class="textarea" name="description" id="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid # dddddd; padding: 10px;"><?= $key->description ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row w-50">
                                            <div class="col-sm-6">
                                                <button onclick="btnupdate(<?= $key->artikel_id ?>)" type="button" class="btn btn-block btn-primary mb-2 btnSimpan">Simpan</button>
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
    function btntambah() {
        window.location.href = "<?= base_url() ?>/admin/artikel/formtambah";
    }

    function btnupdate(id) {
        var artikel_nm = $("#artikel_nm").val();
        var category_id = $("#category_id").val();
        var description = $("#description").val();

        if (artikel_nm == "" || category_id == "") {
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
            jQuery.each($("input[name^='artikel_img")[0].files, function(i, file) {
                ajaxData.append('artikel_img[' + i + ']', file);
            });
            ajaxData.append('artikel_nm', artikel_nm);
            ajaxData.append('category_id', category_id);
            ajaxData.append('description', description);
            ajaxData.append('id', id);

            $.ajax({
                url: "<?= base_url('admin/artikel/updatedata'); ?>",
                type: "POST",
                data: ajaxData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data artikel berhasil diupdate"
                        });
                        window.location.href = "<?= base_url() ?>/admin/artikel";
                    } else {
                        Toast.fire({
                            icon: "warning",
                            title: response
                        });
                    }
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
</script>
<?= $this->endSection(); ?>
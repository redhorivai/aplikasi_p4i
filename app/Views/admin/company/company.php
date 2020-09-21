<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<!-- WRAPPER -->
<div class="content-wrapper text-sm">
    <!-- TITLE & BREADCRUMB -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-organization"></i> <?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('Admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                        <div class="card-body viewdata">
                            <?php foreach ($company as $res) : ?>
                                <form class="formcompany" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div style="border:1px solid #CED4DA;padding:15px;">
                                        <input type="hidden" name="company_id" value="<?= $res->company_id; ?>">
                                        <div class="pl-2 pr-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Name: <b class="text-danger">*</b></label>
                                                        <input type="text" name="company_nm" id="company_nm" class="form-control" placeholder="Company Name" style="text-transform: capitalize;" value="<?= $res->company_nm; ?>" onchange="remove(id)" readonly>
                                                        <div class="invalid-feedback errorName"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Company Phone: <b class="text-danger">*</b></label>
                                                        <input type="text" name="company_phone" id="company_phone" class="form-control" placeholder="Company Phone" style="text-transform: capitalize;" value="<?= $res->company_phone; ?>" onchange="remove(id)" readonly>
                                                        <div class="invalid-feedback errorPhone"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Company E-Mail: <b class="text-danger">*</b></label>
                                                        <input type="text" name="company_email" id="company_email" class="form-control" placeholder="Company E-Mail" value="<?= $res->company_email; ?>" onchange="remove(id)" readonly>
                                                        <div class="invalid-feedback errorEmail"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Address: <b class="text-danger">*</b></label>
                                                        <textarea name="company_address" id="company_address" class="form-control" placeholder="Company Address ..." readonly><?= $res->company_address; ?></textarea>
                                                        <div class="invalid-feedback errorAddress"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Company Logo: <b class="text-danger">*</b></label><br>
                                                        <div class="row text-center">
                                                            <div class="col-sm-12 col-12">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div id="thumb" class="fileinput-new thumbnail bg-dark" style="width:485px;height:180px;border:2px solid #e2e2e2;border-radius:5px;padding:20px;">
                                                                        <img src="<?= base_url(); ?>/img/company/<?= $res->company_logo; ?>" style="width:100%;height:100%;">
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="width:485px;height:180px;border:2px solid #e2e2e2;border-radius:5px;padding:20px;"></div>
                                                                    <div id="btnImg" class="d-none">
                                                                        <span class="btn btn-outline-info btn-file" style="cursor:pointer;">
                                                                            <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                                                                            <span class="fileinput-exists mr-1">Change</span>
                                                                            <input type="file" name="company_logo" id="company_logo" />
                                                                            <input type="hidden" name="logoLama" value="<?= $res->company_logo; ?>">
                                                                        </span>
                                                                        <a href="javascript:void(0)" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                                                                    </div>
                                                                    <small class="errorLogo" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer pl-0 pr-0 pb-0 justify-content-center">
                                            <div class="btn-group" role="group" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;">
                                                <button style="min-width:100px;" type="submit" class="btn btn-info" id="btnSimpan">Simpan</button>
                                                <button style="min-width:100px;" type="button" class="btn btn-success" id="btnUpdate">Update</button>
                                                <button style="min-width:100px;" type="button" class="btn btn-outline-secondary" id="btnBatal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END MAIN CONTENT -->
</div>
<!-- END WRAPPER -->
<script src="<?= base_url(); ?>/admin/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btnSimpan').hide();
        $('#btnBatal').hide();
        $('#btnUpdate').click(function() {
            $('#btnUpdate').hide();
            $('#btnSimpan').show();
            $('#btnBatal').show();
            $('#company_nm').removeAttr('readonly');
            $('#company_phone').removeAttr('readonly');
            $('#company_email').removeAttr('readonly');
            $('#company_address').removeAttr('readonly');
            $('#thumb').removeClass('bg-dark');
            $('#thumb').addClass('bg-gray');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#company_nm').attr('readonly', 'true');
            $('#company_phone').attr('readonly', 'true');
            $('#company_email').attr('readonly', 'true');
            $('#company_address').attr('readonly', 'true');
            $('#thumb').addClass('bg-dark');
            $('#thumb').removeClass('bg-gray');
            $('#btnImg').addClass('d-none');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formcompany').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url('Admin/company/updatedata'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.company_nm) {
                            $('#company_nm').addClass('is-invalid');
                            $('.errorName').html(response.error.company_nm);
                        } else {
                            $('#company_nm').removeClass('is-invalid');
                            $('.errorName').html('');
                        }
                        if (response.error.company_phone) {
                            $('#company_phone').addClass('is-invalid');
                            $('.errorPhone').html(response.error.company_phone);
                        } else {
                            $('#company_phone').removeClass('is-invalid');
                            $('.errorPhone').html('');
                        }
                        if (response.error.company_email) {
                            $('#company_email').addClass('is-invalid');
                            $('.errorEmail').html(response.error.company_email);
                        } else {
                            $('#company_email').removeClass('is-invalid');
                            $('.errorEmail').html('');
                        }
                        if (response.error.company_address) {
                            $('#company_address').addClass('is-invalid');
                            $('.errorAddress').html(response.error.company_address);
                        } else {
                            $('#company_address').removeClass('is-invalid');
                            $('.errorAddress').html('');
                        }
                        if (response.error.company_logo) {
                            $('.errorLogo').html(response.error.company_logo);
                        } else {
                            $('.errorLogo').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#company_nm').attr('readonly', 'true');
                        $('#company_phone').attr('readonly', 'true');
                        $('#company_email').attr('readonly', 'true');
                        $('#company_address').attr('readonly', 'true');
                        $('#btnImg').addClass('d-none');
                        _getLogo();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
            return false;
        });
    });
</script>
<?= $this->endSection(); ?>
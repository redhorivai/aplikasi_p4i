<?= $this->extend('admin/layout/main_layout'); ?>

<?= $this->section('content') ?>
<div class="br-mainpanel">
  <!-- BREADCRUMB -->
  <div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?= base_url('panel/dashboard'); ?>">Dashboard</a>
      <a class="breadcrumb-item" href="<?= base_url('panel/instansi'); ?>">Pengaturan</a>
      <span class="breadcrumb-item active"><?= $title; ?></span>
    </nav>
  </div>
  <!-- END BREADCRUMB -->
  <!-- SECTION TABLE -->
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <?php foreach ($kta as $res) : ?>
        <?php
          if ($res->gender=='L') {
            $jk = "Laki-laki";
          } else {
            $jk = "Perempuan";
          }
        $get_id_user = session()->get('user_id');
          // print_r($get_id_user)
          ?>
        <form class="form-layout form-layout-1 formcompany" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <input type="hidden" name="id" value="<?= $res->id; ?>">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Informasi E-KTA Digital</h6>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label tx-bold">Nama: <span class="tx-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $res->name; ?>" onchange="remove(id)" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label tx-bold">NIK: <span class="tx-danger">*</span></label>
                <input type="text" name="nik" id="nik" class="form-control" value="<?= $res->nik; ?>" onchange="remove(id)" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label tx-bold">Cabang: <span class="tx-danger">*</span></label>
                <input type="text" name="cabang" id="cabang" class="form-control" value="<?= $res->cabang; ?>" onchange="remove(id)" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label tx-bold">Tempat lahir: <span class="tx-danger">*</span></label>
                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $res->tempat_lahir; ?>" onchange="remove(id)" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class='form-group'>
                  <label class='form-control-label tx-bold'>Jenis Kelamin: <span class='tx-danger'>*</span></label>
                  <input type="text" name="gender" id="gender" class="form-control" value="<?= $jk; ?>" onchange="remove(id)" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="form-control-label tx-bold">No Kartu Anggota:</label>
                <input type="text" name="np_anggota" id="np_anggota" class="form-control" value="<?= $res->no_anggota; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label tx-bold">Alamat: <span class="tx-danger">*</span></label>
                <textarea type="text" rows="4" name="address" id="address" class="form-control" onchange="remove(id)" readonly><?= $res->address; ?></textarea>
              </div>
            </div>
            <div class="col-md-6" style="padding-left: 100px;">
                <div class="form-group">
                  <label class="form-control-label tx-bold">Foto Profil e-KTA Digital:</label>
                  <div class="row">
                    <div class="col-sm-12 col-12">
                      <div class="fileinput fileinput-new" data-provides="fileinput">   
                        <div id="thumb" class="fileinput-new thumbnail bg-gray-600" style="border:2px solid #e2e2e2;border-radius:5px;padding:5px;">
                          <img src="<?= base_url(); ?>/assets-front/images/logo/<?= $res->photo; ?>" style="max-height: 100%;max-width:130px">
                        </div>                      
                        <div class="fileinput-preview fileinput-exists thumbnail" style="border:2px solid #e2e2e2;border-radius:5px;padding:5px;"></div>
                        <div id="btnImg" class="d-none">
                          <span class="btn btn-sm btn-outline-info btn-file" style="cursor:pointer;">
                          <span class="fileinput-new" style="padding-left:30px;padding-right:30px;">Browse File</span>
                          <span class="fileinput-exists mr-1">Change</span>
                            <input type="file" name="photo" id="photo" />
                            <input type="hidden" name="logoLama" value="<?= $res->photo; ?>">
                          </span>
                          <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger fileinput-exists" data-dismiss="fileinput" style="cursor:pointer;" id="remove">Remove</a>
                        </div>                                                                               
                        <small class="errorLogo" style="color:#dc3545;font-size: 80%;margin-top: 0.25rem;"></small>
                      </div>                                     
                    </div>                                                            
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer form-layout-footer pl-0 pr-0 pb-0 justify-content-center">
            <div class="btn-group" role="group" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;">
              <button style="min-width:100px;" type="submit" class="btn btn-info" id="btnSimpan">Simpan</button>
              <button style="min-width:100px;border-radius:5px;" type="button" class="btn btn-success" id="btnUpdate">Update</button>
              <button style="min-width:100px;" type="button" class="btn btn-light" id="btnBatal">Batal</button>
              <button style="min-width:100px;border-radius:5px;" type="button" class="btn btn-warning" id="btnKTA"><a href='javascript:void(0)' onclick='_digital_kta(<?= $get_id_user?>,<?= $res->id?>)' style="color:#fff">e-KTA digital</a></button>
              </div>
          </div>
        </form>
      <?php endforeach ?>
    </div>
  </div>
    <div class='modal fade' id='modaldetail' role='dialog' aria-hidden='true'></div>

  <!-- END SECTION TABLE -->
  <?= $this->endSection() ?>
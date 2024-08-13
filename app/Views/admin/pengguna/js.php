<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id != 'gender' && id != 'level') {
            $('#' + id).removeClass('is-invalid');
        } else {
            $('#' + id).removeClass('is-invalid');
            $('#' + id + '+ span').removeClass("is-invalid");
            $('#' + id + '+ span').focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
    }
    $(window).ready(function() {
        _getPengguna();
        $('#checkAll').click(function(e){
            if($(this).is(':checked')){
                $('.checkedId').prop('checked', true);
            } else {
                $('.checkedId').prop('checked', false);
            }
        });
        $('.formMultiDelete').submit(function(e){
            e.preventDefault();
            let jmldata = $('.checkedId:checked');
            if(jmldata.length === 0){
                Swal.fire({
                    title: 'Pemberitahuan',
                    html: 'Silahkan pilih data yang akan dihapus!',
                    icon: 'warning',
                    showConfirmButton: true,
                });
            } else {
                Swal.fire({
                    title: 'Hapus Data?',
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> pengguna</p>`,
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
                        type: "POST",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "JSON",
                        success: function(response) {
                        if (response.sukses) {
                            Toast.fire({
                            icon: "success",
                            html: response.sukses,
                            });
                            $('#checkAll').prop('checked', false);
                            $('#viewTable').DataTable().ajax.reload();
                        }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        },
                    });
                    }
                });
            }
            return false;
        });
    });
    function _getPengguna() {
        $('#viewTable').DataTable({
          responsive: true,
          processing: false,
          serverSide: false,
          language: {
            searchPlaceholder: 'Cari...',
            sSearch: '',
            lengthMenu: '_MENU_',
          },
          "order": [],
          "columnDefs": [
            {"targets": [0,2],"orderable": false},
          ],
          "columns": [
            {"data": "cek"},
            {"data": "col"},
            {"data": "action"},
          ],
          "ajax": "<?= site_url('Backend/Pengguna/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Pengguna/form') ?>",
            success: function(response) {
              $('#formData').html(response);
              $('#viewData').delay(100).fadeOut();
              $('#formData').removeClass('d-none');
              $('#viewTable').DataTable().ajax.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    function _simpan() {
        var name     = $("#name").val();
        var username = $("#username").val();
        var nik     = $("#nik").val();
        var tempat_lahir = $("#tempat_lahir").val();
        var tanggal_lahir    = $("#tanggal_lahir").val();
        var email    = $("#email").val();
        var phone    = $("#phone").val();
        var gender   = $("#gender").val();
        var level    = $("#level").val();
        var address  = $("#address").val();
        if (name == "") {
            $("#name").focus();
            $('#name').addClass('is-invalid');
        } else {
            $('#name').removeClass('is-invalid');
        }
        if (username == "") {
            $('#username').addClass('is-invalid');
        } else {
            $('#username').removeClass('is-invalid');
        }
        if (nik == "") {
            $("#nik").focus();
            $('#nik').addClass('is-invalid');
        } else {
            $('#nik').removeClass('is-invalid');
        }
        if (tempat_lahir == "") {
            $('#tempat_lahir').addClass('is-invalid');
        } else {
            $('#tempat_lahir').removeClass('is-invalid');
        }
        if (tanggal_lahir == "") {
            $('#tanggal_lahir').addClass('is-invalid');
        } else {
            $('#tanggal_lahir').removeClass('is-invalid');
        }
        if (email == "") {
            $('#email').addClass('is-invalid');
        } else {
            $('#email').removeClass('is-invalid');
        }
        if (phone == "") {
            $('#phone').addClass('is-invalid');
        } else {
            $('#phone').removeClass('is-invalid');
        }
        if (gender == "") {
            $("#gender + span").addClass("is-invalid");
            $("#gender + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#gender').removeClass('is-invalid');
            $("#gender + span").removeClass("is-invalid");
            $("#gender + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (level == "") {
            $("#level + span").addClass("is-invalid");
            $("#level + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#level').removeClass('is-invalid');
            $("#level + span").removeClass("is-invalid");
            $("#level + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (name && username && nik && tempat_lahir && tanggal_lahir && email && phone && gender && level) {
            $.ajax({
                url: "<?= site_url('Backend/Pengguna/insert_data') ?>",
                type: "POST",
                data: {
                    name     : name,
                    username : username,
                    nik     : nik,
                    tempat_lahir : tempat_lahir,
                    tanggal_lahir    : tanggal_lahir,
                    email    : email,
                    phone    : phone,
                    gender   : gender,
                    level    : level,
                    address  : address
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data pengguna berhasil ditambahkan"
                        });
                        $('.form-data')[0].reset();
                        $('#formData').addClass('d-none');
                        $('#viewData').delay(100).fadeIn();
                        $('#viewTable').DataTable().ajax.reload();
                    } else {
                        $("#username").focus();
                        $('#username').addClass('is-invalid');
                        Swal.fire({
                            title: 'Pemberitahuan',
                            html: response,
                            icon: 'warning',
                            showConfirmButton: true,
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Error !, Silahkan coba beberapa saat lagi."
                    });
                }
            });
        }
    }
    function _btnEdit(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('Backend/Pengguna/form') ?>",
            data: {
                id: id
            },
            success: function(response) {
                if (response) {
                  $('#formData').html(response);
                  $('#viewData').delay(100).fadeOut();
                  $('#formData').removeClass('d-none');
                  $('#viewTable').DataTable().ajax.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
    function _update(id) {
        var name     = $("#name").val();
        var username = $("#username").val();
        var nik     = $("#nik").val();
        var tempat_lahir = $("#tempat_lahir").val();
        var tanggal_lahir    = $("#tanggal_lahir").val();
        var email    = $("#email").val();
        var phone    = $("#phone").val();
        var gender   = $("#gender").val();
        var level    = $("#level").val();
        var address  = $("#address").val();
        if (name == "") {
            $("#name").focus();
            $('#name').addClass('is-invalid');
        } else {
            $('#name').removeClass('is-invalid');
        }
        if (username == "") {
            $('#username').addClass('is-invalid');
        } else {
            $('#username').removeClass('is-invalid');
        }
        if (nik == "") {
            $("#nik").focus();
            $('#nik').addClass('is-invalid');
        } else {
            $('#nik').removeClass('is-invalid');
        }
        if (tempat_lahir == "") {
            $('#tempat_lahir').addClass('is-invalid');
        } else {
            $('#tempat_lahir').removeClass('is-invalid');
        }
        if (tanggal_lahir == "") {
            $('#tanggal_lahir').addClass('is-invalid');
        } else {
            $('#tanggal_lahir').removeClass('is-invalid');
        }
        if (email == "") {
            $('#email').addClass('is-invalid');
        } else {
            $('#email').removeClass('is-invalid');
        }
        if (phone == "") {
            $('#phone').addClass('is-invalid');
        } else {
            $('#phone').removeClass('is-invalid');
        }
        if (gender == "") {
            $("#gender + span").addClass("is-invalid");
            $("#gender + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#gender').removeClass('is-invalid');
            $("#gender + span").removeClass("is-invalid");
            $("#gender + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (level == "") {
            $("#level + span").addClass("is-invalid");
            $("#level + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#level').removeClass('is-invalid');
            $("#level + span").removeClass("is-invalid");
            $("#level + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (name && username && nik && tempat_lahir && tanggal_lahir && email && phone && gender && level) {
            $.ajax({
                url: "<?= site_url('Backend/Pengguna/update_data') ?>",
                type: "POST",
                data: {
                    name     : name,
                    username : username,
                    nik     : nik,
                    tempat_lahir : tempat_lahir,
                    tanggal_lahir    : tanggal_lahir,
                    email    : email,
                    phone    : phone,
                    gender   : gender,
                    level    : level,
                    address  : address,
                    id       : id,
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data pengguna telah diperbaharui."
                        });
                        $('.form-data')[0].reset();
                        $('#formData').addClass('d-none');
                        $('#viewData').delay(100).fadeIn();
                        $('#viewTable').DataTable().ajax.reload();
                    } else {
                        $("#username").focus();
                        $('#username').addClass('is-invalid');
                        Swal.fire({
                            title: 'Pemberitahuan',
                            html: response,
                            icon: 'warning',
                            showConfirmButton: true,
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Error !, Silahkan coba beberapa saat lagi."
                    });
                }
            });
        }
    }
    function _active(user_id, nama) {
        Swal.fire({
          title: 'Aktivasi Akun?',
          html: `<p class="mg-b-10">Anda akan mengaktifkan akun user:</p><p><b>${nama}</b></p>`,
          icon: 'question',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak, batalkan',
          confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "<?= site_url('Backend/Pengguna/active') ?>",
                data: {
                  user_id: user_id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                    $('#viewTable').DataTable().ajax.reload();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
    function _deactive(user_id, nama) {
        Swal.fire({
          title: 'Nonaktif Akun?',
          html: `<p class="mg-b-10">Anda akan menonaktifkan akun user:</p><p><b>${nama}</b></p>`,
          icon: 'question',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak, batalkan',
          confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "<?= site_url('Backend/Pengguna/deactive') ?>",
                data: {
                  user_id: user_id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                      $('#viewTable').DataTable().ajax.reload();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
    function _resetPassword(user_id, nama) {
        Swal.fire({
          title: 'Atur Ulang Kata Sandi?',
          html: `<p class="mg-b-10">Anda akan mengatur ulang kata sandi akun user:</p><p><b>${nama}</b></p>`,
          icon: 'question',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak, batalkan',
          confirmButtonText: 'Ya, proses',
        }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "POST",
                url: "<?= site_url('Backend/Pengguna/reset_password') ?>",
                data: {
                  user_id: user_id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                      $('#viewTable').DataTable().ajax.reload();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
    function _delData(user_id, nama) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus akun user:</p><p><b>${nama}</b></p>`,
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
                type: "POST",
                url: "<?= site_url('Backend/Pengguna/del_data') ?>",
                data: {
                  user_id: user_id
                },
                dataType: "JSON",
                success: function(response) {
                  if (response.sukses) {
                    Toast.fire({
                      icon: "success",
                      title: response.sukses,
                    });
                      $('#viewTable').DataTable().ajax.reload();
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
              });
            }
        });
    }
    function _digital_kta(user_id) {
        $.ajax({
            url: "<?= site_url('Backend/Pengguna/digital_kta') ?>",
            type: "POST",
            data: {
                user_id: user_id
            },
            success: function(response) {
                $('#modaldetail').html(response);
                $('#modaldetail').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    }
</script>
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
        _getKegiatan();
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
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> kegiatan</p>`,
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
    function _getKegiatan() {
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
          "ajax": "<?= site_url('Backend/Kegiatan/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Kegiatan/form') ?>",
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
        var nama        = $("#nama").val();
        var keterangan  = $("#keterangan").val();
        var start_date  = $("#start_date").val();
        var end_date    = $("#end_date").val();
        if (nama == "") {
            $("#nama").focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (keterangan == "") {
            $('#keterangan').addClass('is-invalid');
        } else {
            $('#keterangan').removeClass('is-invalid');
        }
        if (start_date == "") {
            $('#start_date').addClass('is-invalid');
        } else {
            $('#start_date').removeClass('is-invalid');
        }
        if (end_date == "") {
            $('#end_date').addClass('is-invalid');
        } else {
            $('#end_date').removeClass('is-invalid');
        }
        if (nama && keterangan && start_date && end_date) {
            $.ajax({
                url: "<?= site_url('Backend/Kegiatan/insert_data') ?>",
                type: "POST",
                data: {
                    nama        : nama,
                    keterangan  : keterangan,
                    start_date  : start_date,
                    end_date    : end_date,
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data kegiatan berhasil ditambahkan"
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
            url: "<?= site_url('Backend/Kegiatan/form') ?>",
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
        var nama        = $("#nama").val();
        var keterangan  = $("#keterangan").val();
        var start_date  = $("#start_date").val();
        var end_date    = $("#end_date").val();
        if (nama == "") {
            $("#nama").focus();
            $('#nama').addClass('is-invalid');
        } else {
            $('#nama').removeClass('is-invalid');
        }
        if (keterangan == "") {
            $('#keterangan').addClass('is-invalid');
        } else {
            $('#keterangan').removeClass('is-invalid');
        }
        if (start_date == "") {
            $('#start_date').addClass('is-invalid');
        } else {
            $('#start_date').removeClass('is-invalid');
        }
        if (end_date == "") {
            $('#end_date').addClass('is-invalid');
        } else {
            $('#end_date').removeClass('is-invalid');
        }
        if (nama && keterangan && start_date && end_date) {
            $.ajax({
                url: "<?= site_url('Backend/Kegiatan/update_data') ?>",
                type: "POST",
                data: {
                    nama        : nama,
                    keterangan  : keterangan,
                    start_date  : start_date,
                    end_date    : end_date,
                    id          : id,
                },
                success: function(response) {
                    if (response == "Sukses") {
                        Toast.fire({
                            icon: "success",
                            title: "Data kegiatan telah diperbaharui."
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
    function _active(id, nama) {
        Swal.fire({
          title: 'Aktivasi Kegiatan?',
          html: `<p class="mg-b-10">Anda akan mengaktifkan kegiatan :</p><p><b>${nama}</b></p>`,
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
                url: "<?= site_url('Backend/Kegiatan/active') ?>",
                data: {
                  id: id
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
    function _deactive(id, nama) {
        Swal.fire({
          title: 'Nonaktif Kegiatan?',
          html: `<p class="mg-b-10">Anda akan menonaktifkan kegiatan :</p><p><b>${nama}</b></p>`,
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
                url: "<?= site_url('Backend/Kegiatan/deactive') ?>",
                data: {
                  id: id
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
    function _delData(id, nama) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus kegiatan :</p><p><b>${nama}</b></p>`,
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
                url: "<?= site_url('Backend/Kegiatan/del_data') ?>",
                data: {
                  id: id
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
    function _detail(id) {
        $.ajax({
            url  : "<?= site_url('Backend/Kegiatan/detail') ?>",
            type : "POST",
            data: {
              id: id
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
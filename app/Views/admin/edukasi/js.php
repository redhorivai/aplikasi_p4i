<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id == 'title' || id == 'description') {
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
        _getEdukasi();
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
                    html: `<p class="mg-b-10">Anda akan menghapus <b>${jmldata.length} data</b> edukasi</p>`,
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
    function _getEdukasi() {
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
            "ajax": "<?= site_url('Backend/Edukasi/getData') ?>",
        });
    }
    function _btnAdd() {
        $.ajax({
            url: "<?= site_url('Backend/Edukasi/form') ?>",
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
        var type         = $("#type").val();
        var kategori     = $("#kategori").val();
        var title        = $("#title").val();
        var description  = $("#description").val();
        var path_edukasi = $("#path_edukasi").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('type', type);
        ajaxData.append('title', title);
        ajaxData.append('description', description);
        ajaxData.append('path_edukasi', path_edukasi);
        if (type == "") {
            $("#type + span").addClass("is-invalid");
            $("#type + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#type').removeClass('is-invalid');
            $("#type + span").removeClass("is-invalid");
            $("#type + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (title == "") {
            $('#title').focus();
            $('#title').addClass('is-invalid');
        } else {
            $('#title').removeClass('is-invalid');
        }
        if (path_edukasi == "") {
            $('#path_edukasi').addClass('is-invalid');
        } else {
            $('#path_edukasi').removeClass('is-invalid');
        }
        if (description == "") {
            $('#description').addClass('is-invalid');
        } else {
            $('#description').removeClass('is-invalid');
        } 
        if (type && title && path_edukasi && description ) {
          $.ajax({
              url: "<?= site_url('Backend/Edukasi/insert_data'); ?>",
              type: "POST",
              data: ajaxData,
              contentType: false,
              cache: false,
              processData: false,
              dataType: "json",
              success: function(response) {
                  if (response == "Sukses") {
                      Toast.fire({
                          icon: "success",
                          title: "Edukasi berhasil ditambahkan"
                      });
                      $('.form-data')[0].reset();
                      $('#formData').addClass('d-none');
                      $('#viewData').delay(100).fadeIn();
                      $('#viewTable').DataTable().ajax.reload();
                  } else {
                      $("#title").focus();
                      $('#title').addClass('is-invalid');
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
            url: "<?= site_url('Backend/Edukasi/form') ?>",
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
        var type           = $("#type").val();
        var title          = $("#title").val();
        var path_edukasi   = $("#path_edukasi").val();
        var description    = $("#description").val();

        var ajaxData = new FormData();
        ajaxData.append('action', 'forms');
        ajaxData.append('type', type);
        ajaxData.append('title', title);
        ajaxData.append('path_edukasi', path_edukasi);
        ajaxData.append('description', description);
        ajaxData.append('id', id);
        if (type == "") {
            $("#type + span").addClass("is-invalid");
            $("#type + span").focus(function() {
                $(this).addClass("is-invalid");
            });
        } else {
            $('#type').removeClass('is-invalid');
            $("#type + span").removeClass("is-invalid");
            $("#type + span").focus(function() {
                $(this).removeClass("is-invalid");
            });
        }
        if (title == "") {
            $('#title').focus();
            $('#title').addClass('is-invalid');
        } else {
            $('#title').removeClass('is-invalid');
        }
        if (path_edukasi == "") {
            $('#path_edukasi').focus();
            $('#path_edukasi').addClass('is-invalid');
        } else {
            $('#path_edukasi').removeClass('is-invalid');
        }
        if (description == "") {
            $('#description').addClass('is-invalid');
        } else {
            $('#description').removeClass('is-invalid');
        }
        if (type && title && path_edukasi && description) {
          $.ajax({
              url: "<?= site_url('Backend/Edukasi/update_data'); ?>",
              type: "POST",
              data: ajaxData,
              contentType: false,
              cache: false,
              processData: false,
              dataType: "json",
              success: function(response) {
                  if (response == "Sukses") {
                      Toast.fire({
                          icon: "success",
                          title: "Data berhasil diperbaharui"
                      });
                      $('.form-data')[0].reset();
                      $('#formData').addClass('d-none');
                      $('#viewData').delay(100).fadeIn();
                      $('#viewTable').DataTable().ajax.reload();
                  } else {
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
    function _delData(artikel_id, nama) {
        Swal.fire({
          title: 'Hapus Data?',
          html: `<p class="mg-b-10">Anda akan menghapus Edukasi:</p><p><b>${nama}</b></p>`,
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
                url: "<?= site_url('Backend/Edukasi/del_data') ?>",
                data: {
                  artikel_id: artikel_id
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
    function _detail(artikel_id) {
        $.ajax({
            url  : "<?= site_url('Backend/Edukasi/detail') ?>",
            type : "POST",
            data: {
              artikel_id: artikel_id
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
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/datatables/dataTables.responsive.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript">
    function remove(id) {
        if (id == 'cabang') {
            $('#' + id).removeClass('is-invalid');
        }
    }
    $(document).ready(function() {
        $('#btnSimpan').hide();
        $('#btnBatal').hide();
        $('#btnKTA').show();
        $('#btnUpdate').click(function() {
            $('#btnKTA').hide();
            $('#btnUpdate').hide();
            $('#btnSimpan').show();
            $('#btnBatal').show();
            $('#cabang').removeAttr('readonly');
            $('#thumb').removeClass('bg-gray-600');
            $('#thumb').addClass('bg-gray-800');
            $('#btnImg').removeClass('d-none');
        });
        $('#btnBatal').click(function() {
            $('#btnUpdate').show();
            $('#btnKTA').show();
            $('#btnSimpan').hide();
            $('#btnBatal').hide();
            $('#cabang').attr('readonly', true);
            $('#thumb').addClass('bg-gray-600');
            $('#thumb').removeClass('bg-gray-800');
            $('#btnImg').addClass('d-none');
        });
        $('#remove').click(function(e) {
            e.preventDefault();
            $('.errorLogo').html('');
        });
        $('.formcompany').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= base_url('Backend/KTA/update_data'); ?>",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.cabang) {
                            $('#cabang').addClass('is-invalid');
                        } else {
                            $('#cabang').removeClass('is-invalid');
                        }
                        if (response.error.photo) {
                            $('.errorLogo').html(response.error.photo);
                        } else {
                            $('.errorLogo').html('');
                        }
                    } else {
                        Toast.fire({
                            icon: "success",
                            title: response.sukses,
                        });
                        $('#btnUpdate').show();
                        $('#btnKTA').show();
                        $('#btnSimpan').hide();
                        $('#btnBatal').hide();
                        $('#cabang').attr('readonly', true);
                        $('#thumb').addClass('bg-gray-600');
                        $('#thumb').removeClass('bg-gray-800');
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

    function _digital_kta(id) {
        $.ajax({
            url: "<?= site_url('Backend/KTA/digital_kta') ?>",
            type: "POST",
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
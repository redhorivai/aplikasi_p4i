<script src="<?= base_url(); ?>/assets-admin/panel/lib/popper/popper.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/bootstrap/bootstrap.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/moment/moment.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/jquery-ui/jquery-ui.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/jquery-switchbutton/jquery.switchButton.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/peity/jquery.peity.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/highlightjs/highlight.pack.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/bracket.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/js/sidebar-menu.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/panel/lib/flatpickr/form-pickers.init.js"></script>
<?php 
if ($active == 'pengguna') {
    echo view ('admin/pengguna/js');
} else if ($active == 'kegiatan') {
    echo view ('admin/kegiatan/js');
} else if ($active == 'premi') {
    echo view ('admin/premi/js');
} else if ($active == 'kegiatanmember') {
    echo view ('admin/kegiatanmember/js');
} else if ($active == 'rekappremi' || $active == 'rekapkegiatan') {
    echo view ('admin/rekap/js');
} else if ($active == 'pengumuman') {
    echo view ('admin/pengumuman/js');
} else if ($active == 'ebook') {
    echo view ('admin/ebook/js');
} else if ($active == 'profile') {
    echo view ('admin/profile/js');
} else if ($active == 'informasi_dokter') {
    echo view ('admin/dokter/js');
} else if ($active == 'tarif') {
    echo view ('admin/tarif/js');
} else if ($active == 'artikel') {
    echo view ('admin/artikel/js');
} else if ($active == 'berita') {
    echo view ('admin/berita/js');
} else if ($active == 'edukasi') {
    echo view ('admin/edukasi/js');
} else if ($active == 'kta') {
    echo view ('admin/kta/js');
} else if ($active == 'alur_pelayanan') {
    echo view ('admin/alur_pelayanan/js');
} else if ($active == 'hak_kewajiban') {
    echo view ('admin/hak_kewajiban/js');
} else if ($active == 'tata_tertib') {
    echo view ('admin/tata_tertib/js');
} else if ($active == 'faq') {
    echo view ('admin/faq/js');
} else if ($active == 'produk') {
    echo view ('admin/produk/js');
} else if ($active == 'item_fasilitas') {
        echo view ('admin/item_fasilitas/js');
} else if ($active == 'slider') {
    echo view ('admin/slider/js');
} else if ($active == 'changelog') {
    echo view ('admin/changelog/js');
} else if ($active == 'periode') {
    echo view ('admin/periode/js');
} else if ($active == 'lapor' || $active == 'reportlapor') {
    echo view ('admin/lapor/js');
} else if ($active == 'saran') {
    echo view ('admin/saran/js');
}
?>
<script type="text/javascript">
    // $.sidebarMenu($('.br-sideleft-menu'));
    $.sidebarMenu($('.sidebar-menu'));
    // SWAL TOASTR
    const Toast = Swal.mixin({
        toast            : true,
        position         : "top",
        showConfirmButton: false,
        timer            : 3000,
    });
</script>
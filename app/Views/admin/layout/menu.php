<!-- MENU -->
<div class="br-logo" style="justify-content:center;">
    <a href="<?= base_url('panel/dashboard') ?>">
        <img src="<?= base_url() ?>/assets-admin/panel/images/logo/p4i_logo.png" style="max-width:200px;max-height:52px;">
        <!-- <span>[</span>LOGO <i>APLIKASI</i><span>]</span> -->
    </a>
</div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3"><b>Menu Navigasi</b></label>
    <ul class="sidebar-menu">
      <li class="<?php if ($active == "dashboard") {echo "active";} ?>">
        <a href="<?= base_url('panel/dashboard') ?>">
          <i class="fa fa-home tx-16"></i> <span>Dashboard</span>
        </a>
      </li>

      <?php if (session()->get('level') != 'User') { ?>
      <li class="<?php if ($active == "artikel" || $active == "pengumuman" || $active == "ebook" || $active == "faq") { echo "active";} ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-book"></i> <span>Konten</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "artikel") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/artikel') ?>">- Artikel / Berita</a>
          </li>
          <li class="<?php if ($active == "pengumuman") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/pengumuman') ?>">- Pengumuman</a>
          </li>
          <li class="<?php if ($active == "ebook") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/ebook') ?>">- E-book</a>
          </li>
          <li class="<?php if ($active == "faq") { echo "aktif";} ?>">
                <a href="<?= base_url('panel/faq') ?>">- Frequently Ask & Question</a>
              </li>
        </ul>
      </li>
      <?php } ?>

      <?php if (session()->get('level') == 'Super User') { ?>
      <li class="<?php if ($active == "pengguna" || $active == "kegiatan") { echo "active";} ?>">
        <a href="javascript:void(0)">
        <i class="fa fa-folder"></i> <span>Data Master</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "pengguna") {echo "active";} ?>">
            <a href="<?= base_url('panel/pengguna') ?>">
              <span>- Pengguna</span>
            </a>
          </li>
          <li class="<?php if ($active == "kegiatan") {echo "active";} ?>">
            <a href="<?= base_url('panel/kegiatan') ?>">
              <span>- Agenda Kegiatan</span>
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>

      <li class="<?php if ($active == "premi" || $active == "kegiatanmember") { echo "active";} ?>">
        <a href="javascript:void(0)">
          <i class="fa fa-users"></i> <span>Member</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "premi") {echo "active";} ?>">
                <a href="<?= base_url('panel/premi') ?>">- Premi/Iuran Member</a>
          </li>
          <li class="<?php if ($active == "kegiatanmember") {echo "active";} ?>">
                <a href="<?= base_url('panel/kegiatanmember') ?>">- Kegiatan Member</a>
          </li>
        </ul>
      </li>

      <?php if (session()->get('level') !== 'User') { ?>
      <label class="sidebar-label pd-x-10 mg-t-20 op-3"><b>Menu Rekapitulasi</b></label>  
      <li class="<?php if ($active == "rekappremi" || $active == "rekapkegiatan") { echo "active";} ?>">
        <a href="javascript:void(0)">
        <i class="fa fa-file-pdf-o"></i> <span>Data Rekapitulasi</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li class="<?php if ($active == "rekappremi") {echo "active";} ?>">
            <a href="<?= base_url('panel/rekap-premi') ?>">
              <span>- Rekap Premi/Iuran</span>
            </a>
          </li>
          <li class="<?php if ($active == "rekapkegiatan") {echo "active";} ?>">
            <a href="<?= base_url('panel/rekap-kegiatan') ?>">
              <span>- Rekap Kegiatan</span>
            </a>
          </li>
          <!-- <li class="<?php if ($active == "rekappengaduan") {echo "active";} ?>">
            <a href="<?= base_url('panel/kegiatan') ?>">
              <span>- Rekap Pengaduan</span>
            </a>
          </li> -->
        </ul>
      </li>
      <?php } ?>

      <!--  -->
    </ul>
</div>
<!-- END MENU -->
<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>
<!-- MAIN CONTENT -->
<div class="main-content">
    <!-- SECTION: BREADCRUMB -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-color="#CCC">
      <div class="container pt-30 pb-30">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title"><?= $title; ?></h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="<?= base_url('/'); ?>">Beranda</a></li>
                <li><a href="<?= base_url('/profil'); ?>">Profil</a></li>
                <li class="active text-theme-colored"><?= $title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section class="">
      <div class="container pb-0">
        <div class="row">
          <div class="col-md-8">
            <h3 class="text-gray mt-0 mt-sm-30 mb-0">Selamat Datang Di</h3>
            <h2 class="text-dark mt-0">Perkumpulan Pemberantasan Penyakit Parasitik Indoesia (P4I)</h2>
            <ul class="list theme-colored angle-double-right">
              <li>Didirikan pada tanggal  31 Januari 1976 oleh para pendiri antara lain : dr. Adyatma, MPH, Menteri Kesehatan , Prof.dr. Bintari Roekmono, Dept. Parasitologi FKUI- RSCM. FK –UGM , FK -UNAIR</li>
              <li>Para anggauta P4I adalah para ahli parasitologi dan para pemerhati di bidang parasitologi dan Penyakit Infeksi Tropis </li>
              <li>Berbagai latar belakang Pendidikan : Kedokteran, veteriner, Public Health, Biology ,  promosi Kesehatan</li>
              <li>Berasal dari berbagai unit Pendidikan : FK, FKH, IPB, FKM, POLTEKKES  dan kantor2 Kesehatan ( Kemenkes, Dinas Kesahatan, Puskesmas, BBTKL, KKP,  ) ; Penelitian : Litbangkes, Eijkman -> BRIN , BKPK , LIPI, Labkesda di seluruh Indonesia serta dari Mitra Pembangunan</li>
              <li>Mendukung program Pemerintah melalui Direktorat P2P TV Z – Pencegahan dan Pengendalian Penyakit Tular Vektor dan Zoonosis, Kemenkes; Direktorat Jenderal Pendidikan Tinggi, Kementrian Pendidikan ; Direktorat Jenderal Kesehatan Khewan Kementrian Pertanian ,  Global Fund dan Pemerintah</li>
            </ul>
          </div>
          <br>
          <br>
          <div class="col-md-4">
            <img style="border: 5px solid #555;" src="<?= base_url(); ?>/assets-front/images/about/dr_rita.png">
          </div>
          <br>
          <br>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>
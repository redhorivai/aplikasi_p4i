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
    <section>
      <div class="container">
      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Visi</h3>
            <ul class="list-border-bottom no-padding">
              <li>
                <h5>Menjadi sebuah organisasi Profesi Seminat dengan fokus para penyakit Parasit dan Penyakit tropis dalam mencapai Indonesia Sehat.</h5>
              </li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 pb-sm-20">
            <h3 class="title mb-30 line-bottom">Misi</h3>
            <ul class="list theme-colored angle-double-right">
              <li>Menjadi wadah bagi semua sumber daya baik sumber daya ahli dan sumber daya lainnya untuk mendukung pencegahan dan  pengendalian penyakit parasitik dan penyakit tropis di Indonesia</li>
              <li>Bekerja sama dengan Organisasi serupa para tingkat Regional dan internasional dalam menuju Eliminasi beberapa penyakit tropis terabaikan</li>
              <li>Bermitra dengan organisasi profesi lainnya dan partner pembangunan dibidang penyakit parasitik dan tropis dengan menjunjung konsep ONE HEALTH</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END MAIN CONTENT -->
<?= $this->endSection() ?>
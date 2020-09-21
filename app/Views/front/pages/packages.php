<?= $this->extend('front/layout/template'); ?>

<?= $this->section('content'); ?>
<!-- HEADER SECTION -->
<section class="hero-page bg-black-3" style="padding:25px 0px;">
  <div class="container">
    <h1 class="h2" style="font-size:1.5rem;"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Beranda</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/packages'); ?>">Wedding Planner</a></li>
        <li aria-current="page" class="breadcrumb-item active"><?= $title; ?></li>
      </ol>
    </nav>
  </div>
</section>
<!-- END HEADER SECTION -->
<!-- MAIN SECTION -->
<section class="property-grid-sidebar pt-2 bg-white">
  <div class="container" style="max-width:1250px;">
    <!-- FILTERS -->
    <!-- <div class="filter d-flex justify-content-between align-items-center flex-wrap">
      <div class="sort d-flex align-items-center"><strong>Sort</strong>
        <select id="propertyFilter" name="property_filter" class="selectpicker">
          <option value="low_to_high">Price (Low to Heigh)</option>
          <option value="high_to_low">Price (Heigh to Low)</option>
        </select>
      </div>
      <div class="view d-flex align-items-center"><strong>View</strong>
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a href="#" class="active"><i class="fa fa-th-large"></i></a></li>
          <li class="list-inline-item"><a href="property-list.html"><i class="fa fa-th-list"></i></a></li>
        </ul>
      </div>
    </div> -->
    <!-- END FILTERS -->
    <div class="row">
      <!-- PRODUCT LISTINGS -->
      <?= $resProduct; ?>
      <!-- END PRODUCT LISTINGS -->

      <!-- SIDEBAR -->
      <div class="col-lg-3">
        <div class="property-listing-sidebar">
          <!-- SEARCH -->
          <!-- <div class="widget search-widget">
            <div class="widget-header"><strong class="has-line">Search for Wedding</strong></div>
            <form class="sidebar-search">
              <div class="form-group">
                <input type="text" placeholder="Type your keyword..." class="form-control">
              </div>
              <div class="form-group">
                <select name="category" title="Planner Category" class="selectpicker">
                  <option value="1">Indoor</option>
                  <option value="2">Outdoor</option>
                  <option value="3">Rumah / Lapangan</option>
                  <option value="4">Wedding Organizer</option>
                  <option value="5">Promo</option>
                </select>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-gradient full-width">Search Planner</button>
              </div>
            </form>
          </div> -->
          <!-- END SEARCH -->
          <!-- CATEGORIES -->
          <div class="widget location-widget">
            <div class="widget-header mb-3"><strong class="has-line">Categories</strong></div>
            <div class="d-flex">
              <ul class="list-unstyled mb-0 mr-0 w-100">
                <?php if (count($catPackage) > 0) {
                  foreach ($catPackage as $res) {
                    echo "<li><a href='#'>$res->category_nm</a></li>";
                  }
                } else {
                  echo "<p class='text-center text-thin' style='font-size:13px;'>No category posted yet.</p>";
                }
                ?>
              </ul>
            </div>
          </div>
          <!-- END CATEGORIES -->

          <!-- VIEW PRODUCT -->
          <div class="widget featured-widget">
            <div class="widget-header mb-3"><strong class="has-line">Recently Viewed Packages</strong></div>
            <?php if (count($product) > 0) {
              foreach ($product as $res) {
                echo "<div class='property-thumb d-flex align-items-center'>
                      <div class='image'><img src='/assets/img/property-thumb-2.jpg' class='img-fluid'></div>
                      <div class='text'><a href='#' class='no-anchor-style'>Rivington Hopoken</a>
                      <p>GTb Financial destrict, New York</p><span class='price'>$54.000</span>
                      </div>
                      </div>";
              }
            } else {
              echo "<p class='text-center text-thin' style='font-size:13px;'>No package posted yet.</p>";
            }
            ?>
          </div>
          <!-- END VIEW PRODUCT -->
        </div>
      </div>
      <!-- END SIDEBAR -->
    </div>
  </div>
</section>
<script>
  function detailPackages(id) {
    window.location.href = "<?= base_url() ?>/packages/detail_packages/" + id;
  }
</script>
<!-- END MAIN SECTION -->
<?= $this->endSection(); ?>
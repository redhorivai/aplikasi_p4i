<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/panel', 'Backend\Login::index');
$routes->get('/daftar', 'Backend\Daftar::index');
$routes->get('/panel/dashboard', 'Backend\Dashboard::index');
$routes->get('/panel/kegiatan', 'Backend\Kegiatan::index');
$routes->get('/panel/premi', 'Backend\Premi::index');
$routes->get('/panel/kegiatanmember', 'Backend\Kegiatanmember::index');
$routes->get('/panel/pengumuman', 'Backend\Pengumuman::index');
$routes->get('/panel/ebook', 'Backend\Ebook::index');
$routes->get('/panel/profile', 'Backend\Profile::index');
// $routes->get('/panel/rekappremi', 'Backend\Rekappremi::index');
// $routes->get('/instalasi-it', 'Instalasi_IT::index');
$routes->get('/panel', 'Backend\Login::index');
$routes->get('/panel/dashboard', 'Backend\Dashboard::index');
$routes->get('/panel/artikel', 'Backend\Artikel::index');
$routes->get('/panel/berita', 'Backend\Berita::index');
$routes->get('/panel/edukasi', 'Backend\Edukasi::index');
$routes->get('/panel/kta', 'Backend\KTA::index');
$routes->get('/panel/kta/print_kta', 'Backend\KTA::print_kta');
$routes->get('/panel/pengguna', 'Backend\Pengguna::index');
$routes->get('/panel/rekap-premi', 'Backend\Rekap::rekap_premi');
$routes->get('/panel/rekap-kegiatan', 'Backend\Rekap::index');
$routes->get('/panel/faq', 'Backend\FAQ::index');
$routes->get('/panel/saran', 'Backend\Saran::index');



// $routes->get('/detail_artikel/(:any)/(:num)', 'Informasi::detail_artikel/$1/$2');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

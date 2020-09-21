<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

use App\Models\LoginModel;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\TestimoniModel;
use App\Models\ArtikelModel;
use App\Models\VendorModel;
use App\Models\PortofolioModel;
use App\Models\GalleryModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CompanyModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'date'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		date_default_timezone_set('Asia/Jakarta');
		$this->db = \Config\Database::connect();
		$this->validation = \Config\Services::validation();

		$this->logs = new LoginModel();
		$this->sldr = new SliderModel();
		$this->cate = new CategoryModel();
		$this->tsti = new TestimoniModel();
		$this->artk = new ArtikelModel();
		$this->vndr = new VendorModel();
		$this->port = new PortofolioModel();
		$this->gall = new GalleryModel();
		$this->user = new UserModel();
		$this->prod = new ProductModel();
		$this->comp = new CompanyModel();

		function pendek($date)
		{
			$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");

			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);

			$result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
			return ($result);
		}
		function panjang($date)
		{
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

			$tahun = substr($date, 0, 4);
			$bulan = substr($date, 5, 2);
			$tgl   = substr($date, 8, 2);

			$result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
			return ($result);
		}
	}
}

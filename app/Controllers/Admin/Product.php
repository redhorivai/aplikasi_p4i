<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\VendorModel;
class Product extends BaseController
{
    protected $productmodel;
    protected $categorymodel;
    protected $vendormodel;
    protected $session;
    public function __construct(){
        $this->productmodel = new ProductModel();
        $this->categorymodel = new CategoryModel();
        $this->vendormodel = new VendorModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index() {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }

        $data = [
            'title'    => 'Product',
            'product'  => $this->productmodel->get_product()->getResult()
        ];

        return view('admin/product/product', $data);
    }

    public function formtambah() {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('admin/'));
        }
        $id = $this->request->uri->getSegment(4);
        if ($id == "") {
            $data = [
            'title'    => 'Product',
            'category' => $this->categorymodel->get_category()->getResult(),
            'vendor'   => $this->vendormodel->get_vendor()->getResult()
            ];
            return view('admin/product/formtambah', $data);
        } else {
            $current = count($this->productmodel->getimages($id)->getResult());
            $data = [
            'title'    => 'Product',
            'product'  => $this->productmodel->getbyid($id)->getResult(),
            'category' => $this->categorymodel->get_category()->getResult(),
            'vendor'   => $this->vendormodel->get_vendor()->getResult(),
            'images'   => $this->productmodel->getimages($id)->getResult(),
            'current'  => $current
            ];
            return view('admin/product/formedit', $data);
        } 
    }
        
    public function simpandata() {
        if ($this->request->isAJAX()) {
            $product_cd = strtoupper($this->request->getPost('product_cd'));
            $product_nm = ucwords($this->request->getPost('product_nm'));

            $valid = $this->validate([
                'product_nm' => [
                    'label' => 'Nama produk <b>' . $product_nm . '</b>',
                    'rules' => 'required|is_unique[product.product_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'category_id' => [
                    'label' => 'Kategori produk',
                    'rules' => 'required[product.category_id]',
                    'errors' => [
                        'required'  => 'Silahkan pilih kategori produk',
                    ]
                ],
                'product_img' => [
                    'label' => 'Gambar produk',
                    'rules' => 'uploaded[product_img]|max_size[product_img,8072]|is_image[product_img]|mime_in[product_img,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded'  => 'Silahkan pilih gambar produk',
                        'max_size'  => 'Maksimal ukuran file 3 MB',
                        'is_image'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
                'thumbnail' => [
                    'label' => 'Thumbnail produk',
                    'rules' => 'uploaded[thumbnail]|max_size[thumbnail,8072]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded'  => 'Silahkan pilih gambar thumbnail produk',
                        'max_size'  => 'Maksimal ukuran file 3 MB',
                        'is_image'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = 'Pastikan semua form dan gambar di isi !!';
            } else {
                $fileImg = $this->request->getFile('thumbnail');
                if ($fileImg == "") {
                    $thumbnail = 'no_image.png';
                } else {
                    $thumbnail = $fileImg->getRandomName();
                    $fileImg->move('img/thumbnail', $thumbnail);
                }
                $data = [
                    'product_cd'   => $product_cd,
                    'product_nm'   => $product_nm,
                    'category_id'  => $this->request->getPost('category_id'),
                    'description'  => $this->request->getPost('description'),
                    'thumbnail'  => $thumbnail,
                    'price1'  => $this->request->getPost('price1'),
                    'price2'  => $this->request->getPost('price2'),
                    'created_user' => session()->get('user_id'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'   => 'normal',
                ];
                $product_idx = $this->productmodel->insertproduct($data);

                if ($product_idx != "") {
                    if($imagefile = $this->request->getFiles()){
                       foreach($imagefile['product_img'] as $img){
                          if ($img->isValid() && ! $img->hasMoved()){
                               $newName = $img->getRandomName();
                               $img->move('img/product', $newName);
                               $dataimg = [
                                'fk_id' => $product_idx,
                                'images_nm' => $newName,
                                'images_path' => 'img/product',
                                'type' => 'product',
                                'status_cd' => 'normal',
                                'created_dttm' => date('Y-m-d H:i:s'),
                                'created_user' => $this->session->user_id
                                ];
                                $insertimage = $this->productmodel->simpanimage($dataimg);
                            }
                        }
                    } 
                    $msg = "Sukses";
                } else {
                    $msg = "Gagalproduk";
                }
            }
           
        } else {
            $msg = "Gagalajax";
        }

        return $msg;
    }

    public function updatedata() {
        $product_id = $this->request->getPost('id');
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'product_cd' => [
                    'label' => 'Kode produk',
                    'rules' => 'required[product.product_cd]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'product_nm' => [
                    'label' => 'Nama produk',
                    'rules' => 'required[product.product_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'category_id' => [
                    'label' => 'Kategori produk',
                    'rules' => 'required[product.category_id]',
                    'errors' => [
                        'required'  => 'Silahkan pilih kategori produk',
                    ]
                ],
            ]);
            $msg = "";
            if (!$valid) {
                $msg = 'Pastikan semua form dan gambar di isi !!';
            } else {
                $fileImg = $this->request->getFile('thumbnail');
                if ($fileImg == "") {
                    $data = [
                        'product_cd'   => strtoupper($this->request->getPost('product_cd')),
                        'product_nm'   => ucwords($this->request->getPost('product_nm')),
                        'category_id'  => $this->request->getPost('category_id'),
                        'description'  => $this->request->getPost('description'),
                        'price1'  => $this->request->getPost('price1'),
                        'price2'  => $this->request->getPost('price2'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];
                } else {
                    $thumbnail = $fileImg->getRandomName();
                    $fileImg->move('img/thumbnail', $thumbnail);

                    $data = [
                        'product_cd'   => strtoupper($this->request->getPost('product_cd')),
                        'product_nm'   => ucwords($this->request->getPost('product_nm')),
                        'category_id'  => $this->request->getPost('category_id'),
                        'description'  => $this->request->getPost('description'),
                        'thumbnail'  => $thumbnail,
                        'price1'  => $this->request->getPost('price1'),
                        'price2'  => $this->request->getPost('price2'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];

                }

                $update = $this->productmodel->update($product_id, $data);
                if ($this->request->getFiles() != "") {
                    if ($update) {
                        $imagefile = $this->request->getFiles();
                        if(isset($imagefile['product_img'])){
                           foreach($imagefile['product_img'] as $img){
                              if ($img->isValid() && ! $img->hasMoved()){
                                   $newName = $img->getRandomName();
                                   $img->move('img/product', $newName);
                                   $dataimg = [
                                    'fk_id' => $product_id,
                                    'images_nm' => $newName,
                                    'images_path' => 'img/product',
                                    'type' => 'product',
                                    'status_cd' => 'normal',
                                    'updated_dttm' => date('Y-m-d H:i:s'),
                                    'updated_user' => $this->session->user_id
                                    ];
                                   $insertimage = $this->productmodel->simpanimage($dataimg);
                                }
                            }
                        }
                        return "Sukses";
                    } else {
                        return "Error";
                    }
                }
            }
            echo json_encode($msg);
        } else {
            return "Error";
        }
    }

    public function hapusdata() {
        if ($this->request->isAJAX()) {
            $product_id = $this->request->getPost('product_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'     => 'nullified',
            ];
            $this->productmodel->update($product_id, $data);
            $msg = "Sukses";
            
        } else {
            $msg = "Request Error";
        }

        return $msg;
    }

    public function hapusimg(){
        $data = [
            'nullified_user' => session()->get('user_id'),
            'nullified_dttm' => date('Y-m-d H:i:s'),
            'status_cd'     => 'nullified',
        ];
        $remove = $this->productmodel->removeimg($this->request->getPost('id'), $data);
        if ($remove) {
            $msg = "Sukses";
        } else {
            $msg = "Error";
        }
        
        return $msg;
    }
    //--------------------------------------------------------------------

}

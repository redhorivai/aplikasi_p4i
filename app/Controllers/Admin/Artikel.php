<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\CategoryModel;


class artikel extends BaseController
{
    protected $artikelmodel;
    protected $categorymodel;
    protected $session;
    public function __construct()
    {
        $this->artikelmodel = new ArtikelModel();
        $this->categorymodel = new CategoryModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }
        $data = [
            'title'    => 'Artikel',
            'artikel'  => $this->artikelmodel->get_artikel()->getResult()
        ];
        return view('admin/artikel/artikel', $data);
    }

    public function formtambah()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }
        $id = $this->request->uri->getSegment(4);
        if ($id == "") {
            $data = [
                'title' => 'Form Tambah',
                'cate'  => $this->cate->get_catArticle()->getResult()
            ];
            return view('admin/artikel/formtambah', $data);
        } else {
            $data = [
                'title'   => 'artikel',
                'cate'    => $this->cate->get_catArticle()->getResult(),
                'artikel' => $this->artikelmodel->getbyid($id)->getResult()

            ];
            return view('admin/artikel/formedit', $data);
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $artikel_nm = $this->request->getPost('artikel_nm');
            $type = $this->request->getPost('type');
            $valid = $this->validate([
                'artikel_nm' => [
                    'label' => 'Nama kategori <b>' . $artikel_nm . '</b>',
                    'rules' => 'required|is_unique[artikel.artikel_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'artikel_nm' => $this->validation->getError('artikel_nm'),
                    ]
                ];
            } else {
                if ($imagefile = $this->request->getFiles()) {
                    foreach ($imagefile['artikel_img'] as $img) {
                        if ($img->isValid() && !$img->hasMoved()) {
                            $artikel_img = $img->getRandomName();
                            $img->move('img/artikel', $artikel_img);
                        }
                    }
                } else {
                    $artikel_img = 'no_image.png';
                }

                $data = [
                    'artikel_nm'   => $artikel_nm,
                    'category_id'  => $this->request->getPost('category_id'),
                    'description'  => $this->request->getPost('description'),
                    'artikel_img'  => $artikel_img,
                    'status_cd'    => 'normal',
                    'created_user' => session()->get('user_id'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->artikelmodel->insert($data);
                $msg = "Sukses";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $artikel_nm = $this->request->getPost('artikel_nm');

            $valid = $this->validate([
                'artikel_nm' => [
                    'label' => 'Nama kategori <b>' . $artikel_nm . '</b>',
                    'rules' => 'required',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'artikel_img' => [
                    'label' => 'Gambar produk',
                    'rules' => 'max_size[artikel_img,3072]|is_image[artikel_img]|mime_in[artikel_img,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size'  => 'Maksimal ukuran file 3 MB',
                        'is_image'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg =  $this->validation->getError('artikel_img');
            } else {

                if ($imagefile = $this->request->getFiles()) {
                    foreach ($imagefile['artikel_img'] as $img) {
                        if ($img->isValid() && !$img->hasMoved()) {
                            $artikel_img = $img->getRandomName();
                            $img->move('img/artikel', $artikel_img);
                        }
                    }
                    $data = [
                        'artikel_nm'   => $artikel_nm,
                        'category_id'  => $this->request->getPost('category_id'),
                        'description'  => $this->request->getPost('description'),
                        'artikel_img'  => $artikel_img,
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];
                } else {
                    $data = [
                        'artikel_nm'   => $artikel_nm,
                        'category_id'  => $this->request->getPost('category_id'),
                        'description'  => $this->request->getPost('description'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];
                }
                $this->artikelmodel->update($id, $data);
                $msg = "Sukses";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata() {
        if ($this->request->isAJAX()) {
            $artikel_id = $this->request->getPost('artikel_id');
            $data = [
                'status_cd' => 'nullified',
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'nullified_user' => session()->get('user_id'),
            ];
            $update = $this->artikelmodel->update($artikel_id,$data);
            if ($update) {
                $msg = "Sukses";
            } else {
                $msg = "Error";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------

}

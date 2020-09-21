<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $categorymodel;
    protected $session;
    public function __construct()
    {
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
            'title'    => 'Kategori',
            'category' => $this->categorymodel->get_category()->getResult()
        ];
        return view('admin/category/category', $data);
    }

    public function form()
    {
        $id = $this->request->getPost('id');
        if ($id == "") {
            if ($this->request->isAJAX()) {
                $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                        <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data Kategori</h4>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                        </button>
                        </div>
                        <form class='forms' id='forms' method='POST'>";
                csrf_field();
                $ret .= "<div class='modal-body pt-1 pb-0'>
                        <div class='pl-2 pr-2'>
                        <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                        <div class='form-group'>
                        <label>Nama Kategori: <b class='text-danger'>*</b></label>
                        <input type='text' name='category_nm' id='category_nm' class='form-control' placeholder='Nama Kategori' style='text-transform: capitalize;'>
                        </div>
                        <div class='form-group'>
                        <label>Tipe Kategori: <b class='text-danger'>*</b></label>
                        <select name='type' id='type' class='form-control select2' data-placeholder='-- Pilih Tipe Kategori --' data-allow-clear='true' style='width100%;'>
                        <option value=''></option>
                        <option value='product'>Product</option>
                        <option value='vendor'>Vendor</option>
                        <option value='gallery'>Gallery</option>
                        <option value='portofolio'>Portofolio</option>
                        <option value='artikel'>Artikel</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class='modal-footer justify-content-center'>
                        <button type='button' onclick='btnSimpan()' class='btn btn-info' style='width:80px;'>Simpan</button>
                        <button type='button' class='btn btn-default' data-dismiss='modal' style='width:80px;'>Batal</button>
                        </div>
                        </form>
                    </div>
                </div>";
                $ret .= "<script>$('.select2').select2();</script>";
                return $ret;
            } else {
                exit('Request Error');
            }
        } else {
            $res = $this->categorymodel->getbyid($id)->getResult();
            foreach ($res as $key) {
                if ($this->request->isAJAX()) {
                    $ret = "<div class='modal-dialog'>
                            <div class='modal-content'>
                            <div class='modal-header'>
                            <h4 class='modal-title'><i class='icon-note mr-1'></i> Update Data Kategori</h4>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                            </button>
                            </div>
                            <form class='forms' id='forms' method='POST'>";
                    csrf_field();
                    $ret .= "<div class='modal-body pt-1 pb-0'>
                            <div class='pl-2 pr-2'>
                            <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                            <div class='form-group'>
                            <label>Nama Kategori: <b class='text-danger'>*</b></label>
                            <input type='text' name='category_nm' id='category_nm' class='form-control' placeholder='Nama Kategori' value='$key->category_nm' style='text-transform: capitalize;'>
                            </div>
                            <div class='form-group'>
                            <label>Tipe Kategori: <b class='text-danger'>*</b></label>
                            <select name='type' id='type' class='form-control select2' data-placeholder='-- Pilih Tipe Kategori --' data-allow-clear='true' style='width100%;'>
                            <option value=''></option>
                            <option value='product' " . ($key->type == "product" ? "selected='selected'" : "") . ">Product</option>
                            <option value='vendor' " . ($key->type == "vendor" ? "selected='selected'" : "") . ">Vendor</option>
                            <option value='gallery' " . ($key->type == "gallery" ? "selected='selected'" : "") . ">Gallery</option>
                            <option value='portofolio' " . ($key->type == "portofolio" ? "selected='selected'" : "") . ">Portofolio</option>
                            <option value='artikel' " . ($key->type == "artikel" ? "selected='selected'" : "") . ">Artikel</option>
                            </select>
                            </div>
                            </div>
                            </div>
                            <div class='modal-footer justify-content-center'>
                            <button type='button' onclick='btnupdate($key->category_id)' class='btn btn-success' style='width:80px;'>Update</button>
                            <button type='button' class='btn btn-default' data-dismiss='modal' style='width:80px;'>Batal</button>
                            </div>
                            </form>
                            </div>
                            </div>";
                    $ret .= "<script>$('.select2').select2();</script>";
                    return $ret;
                } else {
                    exit('Request Error');
                }
            }
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $category_nm = ucwords($this->request->getPost('category_nm'));
            $type        = $this->request->getPost('type');

            $cek = $this->cate->cek_category($category_nm, $type);
            if ($cek['category_nm'] != $category_nm && $cek['type'] != $type) {
                $data = [
                    'category_nm'  => $category_nm,
                    'type'         => $type,
                    'status_cd'    => 'normal',
                    'created_user' => session()->get('user_id'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->cate->insert($data);
                $msg = "Sukses";
            } else {
                $msg = "Nama kategori: <b class='text-danger'>$category_nm</b> dan tipe kategori: <b class='text-danger'>$type</b> sudah ada, silahkan coba yang lain.";
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
            $category_nm = $this->request->getPost('category_nm');
            $type = $this->request->getPost('type');

            $valid = $this->validate([
                'category_nm' => [
                    'label' => 'Nama kategori&nbsp;<b>' . $category_nm . '</b>&nbsp;',
                    'rules' => 'required|is_unique[category.category_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = $this->validation->getError('category_nm');
            } else {
                $data = [
                    'category_nm'  => ucwords($category_nm),
                    'type'         => $type,
                    'updated_user' => session()->get('user_id'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $this->cate->update($id, $data);
                $msg = "Sukses";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $category_id = $this->request->getPost('category_id');
            $data = [
                'status_cd' => 'nullified',
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'nullified_user' => session()->get('user_id'),
            ];
            $update = $this->categorymodel->update($category_id, $data);
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

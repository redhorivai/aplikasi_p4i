<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VendorModel;
use App\Models\CategoryModel;

class vendor extends BaseController
{
    protected $vendormodel;
    protected $session;
    public function __construct()
    {
        $this->vendormodel = new VendorModel();
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
            'title'    => 'Vendor',
            'vendor' => $this->vendormodel->get_vendor()->getResult()
        ];
        return view('admin/vendor/vendor', $data);
    }

    public function formtambah()
    {
        $cat = $this->categorymodel->get_category()->getResult();
        $id = $this->request->getPost('id');
        if ($id == "") {
            if ($this->request->isAJAX()) {
                $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                        <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data Vendor</h4>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                        </button>
                        </div>
                        <form class='forms' id='forms' method='POST' enctype='multipart/form-data'>";
                csrf_field();
                $ret .= "<div class='modal-body pt-1 pb-0'>
                         <div class='pl-2 pr-2'>
                         <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                         <div class='form-group'>
                         <label>Nama Vendor: <b class='text-danger'>*</b></label>
                         <input type='text' name='vendor_nm' id='vendor_nm' class='form-control' placeholder='Nama Vendor' style='text-transform: capitalize;'>
                         </div>
                         <div class='form-group'>
                         <label>Tipe Kategori: <b class='text-danger'>*</b></label>
                         <select name='category_id' id='category_id' class='form-control select2' data-placeholder='-- Pilih Tipe Kategori --' data-allow-clear='true' style='width100%;'>";
                foreach ($cat as $key) {
                    $ret .= "<option value=''></option>
                             <option value='$key->category_id'>$key->category_nm</option>";
                }
                $ret .= "</select>
                         </div>         
                         <div class='form-group'>
                         <label>Deskripsi:</label>
                         <textarea name='description' id='description' class='form-control' placeholder='Deskripsi ...'></textarea>
                         </div>
                         <div class='row'>
                         <div class='col-md-12'>
                         <div class='form-group mb-0'>
                         <label>Logo Vendor: <b class='text-danger'>*</b></label><br>
                         <center>
                         <div class='fileinput fileinput-new' data-provides='fileinput'>
                         <div class='fileinput-new thumbnail' style='width:450px;height:150px;'>
                         <img src='" . base_url() . "/img/vendor/vendor.png'>
                         </div>
                         <div class='fileinput-preview fileinput-exists thumbnail' style='width:450px;height:150px;'></div>
                         <div class='text-center'>
                         <span class='btn btn-outline-info btn-file' style='cursor:pointer;'>
                         <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                         <span class='fileinput-exists mr-1'>Change</span>
                         <input type='file' name='vendor_img' id='vendor_img'/>
                         </span>
                         <a href='#' class='btn btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;' id='remove'>Remove</a>
                         </div>
                         </div>
                         </center>
                         </div>
                         </div>
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
            $res = $this->vendormodel->getbyid($id)->getResult();
            foreach ($res as $key) {
                if ($this->request->isAJAX()) {
                    $ret = "<div class='modal-dialog'>
                            <div class='modal-content'>
                            <div class='modal-header'>
                            <h4 class='modal-title'><i class='icon-note mr-1'></i> Update Data Vendor</h4>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                            </button>
                            </div>
                            <form class='forms' id='forms' method='POST' enctype='multipart/form-data'>";
                    csrf_field();
                    $ret .= "<div class='modal-body pt-1 pb-0'>
                             <div class='pl-2 pr-2'>
                             <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                             <div class='form-group'>
                             <label>Nama Vendor: <b class='text-danger'>*</b></label>
                             <input type='text' name='vendor_nm' id='vendor_nm' placeholder='Nama Vendor' class='form-control' value='$key->vendor_nm' style='text-transform: capitalize;'>
                             </div>
                             <div class='form-group'>
                             <label>Tipe Kategori: <b class='text-danger'>*</b></label>
                             <select name='category_id' id='category_id' class='form-control select2' data-placeholder='-- Pilih Tipe Kategori --' data-allow-clear='true' style='width100%;'>";
                    foreach ($cat as $c) {
                        $ret .= "<option value=''></option>
                                 <option value='$c->category_id' " . ($key->category_id == $c->category_id ? "selected='selected'" : "") . ">$c->category_nm</option>";
                    }
                    $ret .= "</select>
                             </div>
                             <div class='form-group'>
                             <label>Deskripsi:</label>
                             <textarea name='description' id='description' class='form-control' placeholder='Deskripsi ...'>$key->description</textarea>
                             </div>
                             <div class='row'>
                             <div class='col-md-12'>
                             <div class='form-group mb-0'>
                             <label>Logo Vendor: <b class='text-danger'>*</b></label><br>
                             <center>
                             <div class='fileinput fileinput-new' data-provides='fileinput'>
                             <div class='fileinput-new thumbnail' style='width:450px;height:150px;'>
                             <img src='../img/vendor/$key->image'>
                             </div>
                             <div class='fileinput-preview fileinput-exists thumbnail' style='width:450px;height:150px;'></div>
                             <div class='text-center'>
                             <span class='btn btn-outline-info btn-file' style='cursor:pointer;'>
                             <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                             <span class='fileinput-exists mr-1'>Change</span>
                             <input type='file' name='vendor_img' id='vendor_img'/>
                             </span>
                             <a href='#' class='btn btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;' id='remove'>Remove</a>
                             </div>
                             </div>
                             </center>
                             </div>
                             </div>
                             </div>
                             </div>
                             </div>
                             <div class='modal-footer justify-content-center'>
                             <button type='button' onclick='btnupdate($key->vendor_id)' class='btn btn-success' style='width:80px;'>Update</button>
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
            $vendor_nm   = ucwords($this->request->getPost('vendor_nm'));
            $category_id = $this->request->getPost('category_id');
            if ($imagefile = $this->request->getFiles()) {
                foreach ($imagefile['vendor_img'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $vendor_img = $img->getRandomName();
                        $img->move('img/vendor', $vendor_img);
                    }
                }
            } else {
                $vendor_img = 'vendor.png';
            }
            $data = [
                'vendor_nm'    => $vendor_nm,
                'category_id'  => $category_id,
                'image'        => $vendor_img,
                'description'  => $this->request->getPost('description'),
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $this->vendormodel->insert($data);
            $msg = "Sukses";

            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $vendor_nm = $this->request->getPost('vendor_nm');
            $category_id = $this->request->getPost('category_id');

            $valid = $this->validate([
                'vendor_nm' => [
                    'label' => 'Nama kategori <b>' . $vendor_nm . '</b>',
                    'rules' => 'required',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = $this->validation->getError('vendor_nm');
            } else {
                if ($imagefile = $this->request->getFiles()) {
                    foreach ($imagefile['vendor_img'] as $img) {
                        if ($img->isValid() && !$img->hasMoved()) {
                            $vendor_img = $img->getRandomName();
                            $img->move('img/vendor', $vendor_img);
                        }
                    }
                    $data = [
                        'vendor_nm'  => ucwords($vendor_nm),
                        'category_id' => $category_id,
                        'image' => $vendor_img,
                        'description' => $this->request->getPost('description'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                        'status_cd'   => 'normal',
                    ];
                } else {
                    $data = [
                        'vendor_nm'  => ucwords($vendor_nm),
                        'category_id' => $category_id,
                        'description' => $this->request->getPost('description'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                        'status_cd'   => 'normal',
                    ];
                }
                $this->vendormodel->update($id, $data);
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
            $vendor_id = $this->request->getPost('vendor_id');
            $data = [
                'status_cd'      => 'nullified',
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
            ];
            $this->vndr->update($vendor_id, $data);
            $msg = "Sukses";
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------

}

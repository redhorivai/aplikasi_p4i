<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SliderModel;

class Slider extends BaseController
{
    protected $slidermodel;
    protected $session;
    public function __construct()
    {
        $this->slidermodel = new SliderModel();
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
            'title'    => 'Slider',
            'slider'    => $this->slidermodel->get_slider()->getResult()
        ];
        return view('admin/slider/slider', $data);
    }


    public function formtambah()
    {
        $id = $this->request->getPost('slider_id');
        if ($id == "") {
            $ret = "<div class='modal-dialog'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                    <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data Slider</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                    </button>
                    </div>
                    <form class='forms' id='forms' method='POST' enctype='multipart/form-data'>
                    " . csrf_field() . "
                    <div class='modal-body pt-1 pb-0'>
                    <div class='pl-2 pr-2'>
                    <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                    <div class='form-group'>
                    <label>Judul Slider:</label>
                    <input type='text' name='title' id='title' class='form-control' placeholder='Judul Slider'>
                    </div>
                    <div class='form-group'>
                    <label>Sub Judul Slider:</label>
                    <input type='text' name='sub_title' id='sub_title' class='form-control' placeholder='Sub Judul Slider'>
                    </div>
                    <div class='row'>
                    <div class='col-md-12'>
                    <div class='form-group mb-0'>
                    <label>Gambar Slider: <b class='text-danger'>*</b></label><br>
                    <center>
                    <div class='fileinput fileinput-new' data-provides='fileinput'>
                    <div class='fileinput-new thumbnail' style='width:450px;height:150px;'>
                    <img src='" . base_url() . "/img/slider/slider.png'>
                    </div>
                    <div class='fileinput-preview fileinput-exists thumbnail' style='width:450px;height:150px;'></div>
                    <div class='text-center'>
                    <span class='btn btn-outline-info btn-file' style='cursor:pointer;'>
                    <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                    <span class='fileinput-exists mr-1'>Change</span>
                    <input type='file' name='slider_img' id='slider_img'/>
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
        } else {
            $res = $this->sldr->getbyid($id)->getResult();
            foreach ($res as $key) {
                $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                        <h4 class='modal-title'><i class='icon-note mr-1'></i> Update Data Slider</h4>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                        </button>
                        </div>
                        <form class='forms' id='forms' method='POST' enctype='multipart/form-data'>
                        " . csrf_field() . "
                        <div class='modal-body pt-1 pb-0'>
                        <div class='pl-2 pr-2'>
                        <p style='font-size:80%;margin-bottom:0.7rem;'><i><b>Note:</b> kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</i></p>
                        <div class='form-group'>
                        <label>Judul Slider:</label>
                        <input type='text' name='title' id='title' value='$key->title' class='form-control' placeholder='Judul Slider'>
                        </div>
                        <div class='form-group'>
                        <label>Sub Judul Slider:</label>
                        <input type='text' name='sub_title' id='sub_title' value='$key->sub_title' class='form-control' placeholder='Sub Judul Slider'>
                        </div>
                        <div class='row'>
                        <div class='col-md-12'>
                        <div class='form-group mb-0'>
                        <label>Gambar Slider: <b class='text-danger'>*</b></label><br>
                        <center>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                        <div class='fileinput-new thumbnail' style='border:2px solid #e2e2e2;border-radius: 5px;'>
                        <img src='" . base_url() . "/img/slider/$key->slider_img'>
                        </div>
                        <div class='fileinput-preview fileinput-exists thumbnail' style='border:2px solid #e2e2e2;'>
                        </div>
                        <div class='text-center'>
                        <span class='btn btn-outline-info btn-file' style='cursor:pointer;'>
                        <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                        <span class='fileinput-exists mr-1'>Change</span>
                        <input type='hidden' name='slider_img2' id='slider_img2' value='$key->slider_img'/>
                        <input type='file' name='slider_img' id='slider_img'/>
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
                        <button type='button' onclick='btnupdate($key->slider_id)' class='btn btn-success' style='width:80px;'>Update</button>
                        <button type='button' class='btn btn-default' data-dismiss='modal' style='width:80px;'>Batal</button>
                        </div>
                        </form>
                        </div>
                        </div>";
            }
        }
        return $ret;
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'slider_img' => [
                    'label' => 'Slider Image',
                    'rules' => 'uploaded[slider_img]|max_size[slider_img,3072]|is_image[slider_img]|mime_in[slider_img,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih file gambar',
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = $this->validation->getError('slider_img');
            } else {

                if ($imagefile = $this->request->getFiles()) {
                    foreach ($imagefile['slider_img'] as $img) {
                        if ($img->isValid() && !$img->hasMoved()) {
                            $slider_img = $img->getRandomName();
                            $img->move('img/slider', $slider_img);
                        }
                    }
                } else {
                    $slider_img = 'slider.png';
                }

                $data = [
                    'title'        => $this->request->getPost('title'),
                    'sub_title'    => $this->request->getPost('sub_title'),
                    'slider_img'   => $slider_img,
                    'created_user' => session()->get('user_id'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_act'   => 'normal',
                ];
                $this->slidermodel->insert($data);
                $msg = 'Sukses';
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }


    public function updatedata()
    {
        $slider_id = $this->request->getPost('slider_id');
        if ($this->request->isAJAX()) {

            if ($imagefile = $this->request->getFiles()) {
                foreach ($imagefile['slider_img'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $slider_img = $img->getRandomName();
                        $img->move('img/slider', $slider_img);
                    }
                }

                $data = [
                    'title'        => $this->request->getPost('title'),
                    'sub_title'    => $this->request->getPost('sub_title'),
                    'slider_img'   => $slider_img,
                    'updated_user' => session()->get('user_id'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
            } else {
                $data = [
                    'title'        => $this->request->getPost('title'),
                    'sub_title'    => $this->request->getPost('sub_title'),
                    'updated_user' => session()->get('user_id'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
            }


            $this->slidermodel->update($slider_id, $data);
            $msg = 'Sukses';
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $slider_id = $this->request->getPost('slider_id');
            $data = [
                'status_cd'      => 'nullified',
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->slidermodel->update($slider_id, $data);
            if ($update) {
                $msg = 'Sukses';
            } else {
                $msg = 'Error';
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $slider_id = $this->request->getPost('slider_id');
            $res = $this->slidermodel->getbyid($slider_id)->getResult();

            $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title'><i class='icon-film mr-1'></i> Detail Slider</h4>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <h4 class='text-center'>";
            if (empty($res[0]->title)) {
                $ret .= 'No Title';
            } else {
                $ret .= '' . $res[0]->title . '';
            }

            $ret .= "</h4>
                                        <p class='text-center'>";
            if (empty($res[0]->sub_title)) {
                $ret .= '-';
            } else {
                $ret .= '' . $res[0]->sub_title . '';
            }

            $ret .= "</p>
                                        <img class='img-fluid' src='" . base_url() . "/img/slider/" . $res[0]->slider_img . "'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";

            return $ret;
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------

}

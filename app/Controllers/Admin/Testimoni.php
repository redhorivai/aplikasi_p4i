<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TestimoniModel;
use App\Models\CategoryModel;

class testimoni extends BaseController
{
    protected $testimonimodel;
    protected $session;
    public function __construct(){
        $this->testimonimodel = new TestimoniModel();
        $this->categorymodel = new CategoryModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index() {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }
        $data = [
            'title'    => 'Testimoni',
            'testimoni' => $this->testimonimodel->getbynormal()->getResult()
        ];
        return view('admin/testimoni/testimoni', $data);
    }

    public function formtambah() {
    $cat = $this->categorymodel->get_category()->getResult();
    $id = $this->request->getPost('id');
    if ($id == "") {
        if ($this->request->isAJAX()) {
            $ret = "<div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data testimoni</h4>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                            </button>
                        </div>
                    <form class='forms' id='forms' method='post' enctype='multipart/form-data'>";
                        csrf_field();
                    $ret .= "<div class='modal-body'>
                            <div class='pl-2 pr-2'>
                                <div class='form-group'>
                                    <label>Nama: <b class='text-danger'>*</b></label>
                                    <input type='text' name='nama' id='nama' class='form-control' placeholder='Nama' style='text-transform: capitalize;'>
                                    <div class='invalid-feedback errorName'></div>
                                </div>
                                <div class='form-group'>
                                    <label>Email: <b class='text-danger'>*</b></label>
                                    <input type='email' name='email' id='email' class='form-control' placeholder='Email' style='text-transform: capitalize;'>
                                    <div class='invalid-feedback errorName'></div>
                                </div>
                                <div class='col-md-12'>          
                                    <div class='form-group'>
                                       <label>Description:</label>
                                       <textarea name='description' id='description' class='form-control' placeholder='Description ...'></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer justify-content-center'>
                            <div class='row w-100'>
                                <div class='col-sm-6'>
                                    <button onclick='btnSimpan()' type='button' class='btn btn-block btn-primary mb-2 btnSimpan'>Simpan</button>
                                </div>
                                <div class='col-sm-6'>
                                    <button type='button' class='btn btn-block btn-outline-secondary mb-2' data-dismiss='modal'>Batal</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>";
            return $ret;
        } else {
            exit('Request Error');
        }
    } else {
        $res = $this->testimonimodel->getbyid($id)->getResult();
        foreach ($res as $key) {
           if ($this->request->isAJAX()) {
            $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data testimoni</h4>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                </button>
                            </div>
                        <form class='forms' id='forms' method='post' enctype='multipart/form-data'>";
                            csrf_field();
                        $ret .= "<div class='modal-body'>
                                <div class='pl-2 pr-2'>
                                    <div class='form-group'>
                                        <label>testimoni Name: <b class='text-danger'>*</b></label>
                                        <input type='text' name='nama' id='nama' class='form-control' value='$key->nama' style='text-transform: capitalize;'>
                                        <div class='invalid-feedback errorName'></div>
                                    </div>
                                    <div class='form-group'>
	                                    <label>Email: <b class='text-danger'>*</b></label>
	                                    <input type='email' name='email' id='email' class='form-control' placeholder='Email' style='text-transform: capitalize;' value='$key->email'>
	                                    <div class='invalid-feedback errorName'></div>
	                                </div>
	                                 <div class='col-md-12'>          
	                                    <div class='form-group'>
	                                       <label>Description:</label>
	                                       <textarea name='description' id='description' class='form-control' placeholder='Description ...'>$key->isi</textarea>
	                                    </div>
	                                </div>
                                </div>
                            </div>
                            <div class='modal-footer justify-content-center'>
                                <div class='row w-100'>
                                    <div class='col-sm-6'>
                                        <button onclick='btnupdate($key->testimoni_id)' type='button' class='btn btn-block btn-primary mb-2 btnSimpan'>Simpan</button>
                                    </div>
                                    <div class='col-sm-6'>
                                        <button type='button' class='btn btn-block btn-outline-secondary mb-2' data-dismiss='modal'>Batal</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>";
                return $ret;
            } else {
                exit('Request Error');
            }
        }
        
    }
    

        
    }
    public function simpandata() {
        if ($this->request->isAJAX()) {
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $description = $this->request->getPost('description');
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama <b>' . $nama . '</b>',
                    'rules' => 'required|is_unique[testimoni.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = $this->validation->getError('nama');
            } else {
                $data = [
                    'nama'  => $nama,
                    'email' => $email,
                    'isi' => $this->request->getPost('description'),
                    'approved_user' => session()->get('user_id'),
                    'approved_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'   => 'normal',
                ];
                $this->testimonimodel->insert($data);
                $msg = "Sukses";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function updatedata() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');


            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama <b>' . $nama . '</b>',
                    'rules' => 'required',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = $this->validation->getError('nama');
            } else {
                $data = [
                    'nama'  => $nama,
                    'email' => $email,
                    'isi' => $this->request->getPost('description'),
                    'approved_user' => session()->get('user_id'),
                    'approved_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'   => 'normal',
                ];
                $this->testimonimodel->update($id,$data);
                $msg = "Sukses";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

public function approved() {
    $id = $this->request->getPost('id');
    $data = [
        'status_cd' => 'approved',
        'updated_dttm' => date('Y-m-d H:i:s'),
        'updated_user' => session()->get('user_id'),
    ];

    $update = $this->testimonimodel->update($id,$data);
    if ($update) {
        $msg = "Sukses";
    } else {
        $msg = "Error";
    }
}

public function rejected() {
    $id = $this->request->getPost('id');
    $data = [
        'status_cd' => 'rejected',
        'updated_dttm' => date('Y-m-d H:i:s'),
        'updated_user' => session()->get('user_id'),
    ];

    $update = $this->testimonimodel->update($id,$data);
    if ($update) {
        $msg = "Sukses";
    } else {
        $msg = "Error";
    }
}

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $testimoni_id = $this->request->getPost('testimoni_id');
            $data = [
                'status_cd' => 'nullified',
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'nullified_user' => session()->get('user_id'),
            ];
            $update = $this->testimonimodel->update($testimoni_id,$data);
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

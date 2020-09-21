<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $usermodel;
    protected $session;
    public function __construct()
    {
        $this->usermodel = new UserModel();
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
            'title'    => 'User',
            'user'  => $this->usermodel->get_user()->getResult()
        ];
        return view('admin/user/user', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'user'  => $this->user->get_user(),
            ];
            $msg = [
                'data' => view('admin/user/v_table', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function formtambah()
    {
        $id = $this->request->getPost('id');
        if ($id == "") {
            if ($this->request->isAJAX()) {
                $ret = "<div class='modal-dialog modal-xl'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data User</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                    </button>
                                </div>
                                <form class='forms' id='forms' method='post' enctype='multipart/form-data'>";
                csrf_field();
                $ret .= "<div class='modal-body'>
                                    <div class='pl-2 pr-2'>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Fullname: <b class='text-danger'>*</b></label>
                                                <input type='text' name='name' id='name' class='form-control' placeholder='Fullname' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorName'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Username: <b class='text-danger'>*</b></label>
                                                <input type='text' name='username' id='username' class='form-control' placeholder='Username'>
                                                <div class='invalid-feedback errorUsername'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Gender: <b class='text-danger'>*</b></label>
                                                <select class='form-control select2' name='gender' id='gender' data-placeholder='-- Select Gender --' data-allow-clear='true' style='width: 100%;'>
                                                    <option value=''></option>
                                                    <option value='L'>Laki-Laki</option>
                                                    <option value='P'>Perempuan</option>
                                                </select>
                                                <div class='invalid-feedback errorGender'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Level: <b class='text-danger'>*</b></label>
                                                <select class='form-control select2' name='level' id='level' data-placeholder='-- Select Level User --' data-allow-clear='true' style='width: 100%;'>
                                                    <option value=''></option>
                                                    <option value='superuser'>Super User</option>
                                                    <option value='admin'>Admin</option>
                                                    <option value='user'>User</option>
                                                </select>
                                                <div class='invalid-feedback errorLevel'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Jabatan: <b class='text-danger'>*</b></label>
                                                <input type='text' name='jabatan' id='jabatan' class='form-control' placeholder='Jabatan'>
                                                <div class='invalid-feedback errorJabatan'></div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Facebook: <b class='text-danger'>*</b></label>
                                                <input type='text' name='facebook' id='facebook' class='form-control' placeholder='Facebook' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorFacebook'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>No Telephone: <b class='text-danger'>*</b></label>
                                                <input type='text' name='cellphone' id='cellphone' class='form-control' placeholder='No Telephone'>
                                                <div class='invalid-feedback errorCellphone'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Email: <b class='text-danger'>*</b></label>
                                                <input type='email' name='text' id='password' class='form-control' placeholder='Email'>
                                                <div class='invalid-feedback errorEmail'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Instagram: <b class='text-danger'>*</b></label>
                                                <input type='text' name='instagram' id='instagram' class='form-control' placeholder='Instagram' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorInstagram'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Twitter: <b class='text-danger'>*</b></label>
                                                <input type='text' name='twitter' id='twitter' class='form-control' placeholder='Twitter' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorTwitter'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Avatar: <b class='text-danger'>*</b></label>
                                                <input type='file' name='avatar' id='avatar' class='form-control' placeholder='Instagram' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorAvatar'></div>
                                            </div>
                                        </div>
                                    </div
                                        
                                    </div>
                                </div>
                                <div class='modal-footer justify-content-center'>
                                    <div class='row w-100'>
                                        <div class='col-sm-6'>
                                            <button onclick='btnSimpan()' type='button' class='btn btn-block btn-primary mb-2'>Simpan</button>
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
                return 'Request Error';
            }
        } else {
            $res = $this->usermodel->getbyid($id)->getResult();
            foreach ($res as $key) {
                if ($this->request->isAJAX()) {
                    $ret = "<div class='modal-dialog modal-xl'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title'><i class='icon-plus mr-1'></i> Tambah Data User</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                    </button>
                                </div>
                                <form class='forms' id='forms' method='post' enctype='multipart/form-data'>";
                    csrf_field();
                     $ret .= "<div class='modal-body'>
                                    <div class='pl-2 pr-2'>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Fullname: <b class='text-danger'>*</b></label>
                                                <input value='$key->name' type='text' name='name' id='name' class='form-control' placeholder='Fullname' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorName'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Username: <b class='text-danger'>*</b></label>
                                                <input value='$key->username' type='text' name='username' id='username' class='form-control' placeholder='Username'>
                                                <div class='invalid-feedback errorUsername'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Gender: <b class='text-danger'>*</b></label>
                                                <select class='form-control select2' name='gender' id='gender' data-placeholder='-- Select Gender --' data-allow-clear='true' style='width: 100%;'>
                                                    <option value=''></option>
                                                    <option ".($key->gender == "L" ? "selected='selected'" : "")." value='L'>Laki-Laki</option>
                                                    <option ".($key->gender == "P" ? "selected='selected'" : "")." value='P'>Perempuan</option>
                                                </select>
                                                <div class='invalid-feedback errorGender'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Level: <b class='text-danger'>*</b></label>
                                                <select class='form-control select2' name='level' id='level' data-placeholder='-- Select Level User --' data-allow-clear='true' style='width: 100%;'>
                                                    <option value=''></option>
                                                    <option ".($key->level == "superuser" ? "selected='selected'" : "")." value='superuser'>Super User</option>
                                                    <option ".($key->level == "admin" ? "selected='selected'" : "")." value='admin'>Admin</option>
                                                    <option ".($key->level == "user" ? "selected='selected'" : "")." value='user'>User</option>
                                                </select>
                                                <div class='invalid-feedback errorLevel'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Jabatan: <b class='text-danger'>*</b></label>
                                                <input value='$key->jabatan' type='text' name='jabatan' id='jabatan' class='form-control' placeholder='Jabatan'>
                                                <div class='invalid-feedback errorJabatan'></div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Facebook: <b class='text-danger'>*</b></label>
                                                <input value='$key->facebook' type='text' name='facebook' id='facebook' class='form-control' placeholder='Facebook' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorFacebook'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>No Telephone: <b class='text-danger'>*</b></label>
                                                <input value='$key->cellphone' type='text' name='cellphone' id='cellphone' class='form-control' placeholder='No Telephone'>
                                                <div class='invalid-feedback errorCellphone'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Email: <b class='text-danger'>*</b></label>
                                                <input value='$key->email' type='text' name='email' id='password' class='form-control' placeholder='Email'>
                                                <div class='invalid-feedback errorEmail'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Instagram: <b class='text-danger'>*</b></label>
                                                <input value='$key->instagram' type='text' name='instagram' id='instagram' class='form-control' placeholder='Instagram' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorInstagram'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Twitter: <b class='text-danger'>*</b></label>
                                                <input value='$key->twitter' type='text' name='twitter' id='twitter' class='form-control' placeholder='Twitter' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorTwitter'></div>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Avatar: <b class='text-danger'>*</b></label>
                                                <input type='file' name='avatar' id='avatar' class='form-control' placeholder='Instagram' style='text-transform: capitalize;'>
                                                <div class='invalid-feedback errorAvatar'></div>
                                            </div>
                                        </div>
                                    </div
                                        
                                    </div>
                                </div>
                                <div class='modal-footer justify-content-center'>
                                    <div class='row w-100'>
                                        <div class='col-sm-6'>
                                            <button onclick='btnupdate($key->user_id)' type='button' class='btn btn-block btn-primary mb-2'>Simpan</button>
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
                    return 'Request Error';
                }
            }
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getPost('username');
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama user',
                    'rules' => 'required[user.name]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'username' => [
                    'label' => 'Username <b>' . strtolower($username) . '</b>',
                    'rules' => 'required|is_unique[user.username]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                        'is_unique' => '{field} sudah ada, silahkan coba yang lain.'
                    ]
                ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required[user.gender]',
                    'errors' => [
                        'required'  => 'Silahkan pilih gender',
                    ]
                ],
                'level' => [
                    'label' => 'Level user',
                    'rules' => 'required[user.level]',
                    'errors' => [
                        'required'  => 'Silahkan pilih level user',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = $this->validation->getError('username');
            } else {
                $fileImg = $this->request->getFile('avatar');
                if ($fileImg == "") {
                    $avatar = 'no_image.png';
                } else {
                    $avatar = $fileImg->getRandomName();
                    $fileImg->move('img/user', $avatar);
                }

                $data = [
                    'name'         => ucwords($this->request->getPost('name')),
                    'username'     => strtolower($username),
                    'gender'       => $this->request->getPost('gender'),
                    'level'        => $this->request->getPost('level'),
                    'password'     => sha1(md5('123456')),
                    'jabatan'      => $this->request->getPost('jabatan'),
                    'facebook'     => $this->request->getPost('facebook'),
                    'instagram'    => $this->request->getPost('instagram'),
                    'twitter'      => $this->request->getPost('twitter'),
                    'email'        => $this->request->getPost('email'),
                    'cellphone'    => $this->request->getPost('cellphone'),
                    'avatar'       => $avatar,
                    'created_user' => session()->get('user_id'),
                    'created_dttm' => date('Y-m-d H:i:s'),
                    'status_acc'   => 'active',
                    'status_act'   => 'normal',
                ];
                $insert = $this->usermodel->insert($data);
                if ($insert) {
                    $msg = "Sukses";
                } else {
                    $msg = "Error";
                }
            }
            
        } else {
            $msg = "Request Error";
        }
        return $msg;
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getPost('id');
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama user',
                    'rules' => 'required[user.name]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'gender' => [
                    'label' => 'Gender',
                    'rules' => 'required[user.gender]',
                    'errors' => [
                        'required'  => 'Silahkan pilih gender',
                    ]
                ],
                'level' => [
                    'label' => 'Level user',
                    'rules' => 'required[user.level]',
                    'errors' => [
                        'required'  => 'Silahkan pilih level user',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = "Fullname/Jenis Kelamin/level harus di isi";
            } else {

                $fileImg = $this->request->getFile('avatar');
                if ($fileImg == "") {
                    $data = [
                        'name'         => ucwords($this->request->getPost('name')),
                        'username'     => $this->request->getPost('username'),
                        'gender'       => $this->request->getPost('gender'),
                        'level'        => $this->request->getPost('level'),
                        'jabatan'      => $this->request->getPost('jabatan'),
                        'facebook'     => $this->request->getPost('facebook'),
                        'instagram'    => $this->request->getPost('instagram'),
                        'twitter'      => $this->request->getPost('twitter'),
                        'email'        => $this->request->getPost('email'),
                        'cellphone'    => $this->request->getPost('cellphone'),
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];
                } else {
                    $avatar = $fileImg->getRandomName();
                    $fileImg->move('img/user', $avatar);
                    $data = [
                        'name'         => ucwords($this->request->getPost('name')),
                        'username'     => $this->request->getPost('username'),
                        'gender'       => $this->request->getPost('gender'),
                        'level'        => $this->request->getPost('level'),
                        'jabatan'      => $this->request->getPost('jabatan'),
                        'facebook'     => $this->request->getPost('facebook'),
                        'instagram'    => $this->request->getPost('instagram'),
                        'twitter'      => $this->request->getPost('twitter'),
                        'email'        => $this->request->getPost('email'),
                        'cellphone'    => $this->request->getPost('cellphone'),
                        'avatar'       => $avatar,
                        'updated_user' => session()->get('user_id'),
                        'updated_dttm' => date('Y-m-d H:i:s'),
                    ];
                }
                $update = $this->usermodel->update($user_id, $data);
                if ($update) {
                    $msg = "Sukses";
                } else {
                    $msg = "Error";
                }
                
                
            }
            return $msg;
        } else {
            return "Error";
        }
    }

    public function deactive()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getPost('user_id');
            $data = [
                'status_acc' => 'deactive',
            ];
            $this->usermodel->update($user_id, $data);
            $msg = [
                'sukses' => 'Data user telah di nonaktifkan'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function active()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getPost('user_id');
            $data = [
                'status_acc' => 'active',
            ];
            $this->usermodel->update($user_id, $data);
            $msg = [
                'sukses' => 'Data user telah di aktifkan'
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getPost('user_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_act'     => 'nullified',
            ];
            $this->usermodel->update($user_id, $data);
            $msg = "Sukses";
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getPost('user_id');
            $res     = $this->usermodel->getbyid($user_id)->getResult();
            foreach ($res as $key) {
                $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title'><i class='icon-user mr-1'></i> User Profile</h4>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <div class='card bg-light mb-0' style='border-radius:10px;'>
                                    <div class='card-header text-muted border-bottom-0'>
                                        @$key->username
                                    </div>
                                    <div class='card-body pt-0'>
                                        <div class='row'>
                                            <div class='col-7'>
                                                <h2 class='lead mb-0'><b>$key->name</b></h2>
                                                <p class='text-muted text-sm'>";

                if ($key->level == 1) {
                    $ret .= "Super User";
                } else if ($key->level == 2) {
                    $ret .= "Admin";
                } else if ($key->level == 3) {
                    $ret .= "User";
                }

                $ret .= "</p>
                                                <ul class='ml-4 mb-0 fa-ul text-muted'>
                                                    <li class='small mb-1'>
                                                        <span class='fa-li'>
                                                            <i class='icon-home' style='font-size: 1.33333em;line-height: .75em;vertical-align: -.0667em;font-weight:bold;color:#007bff;'></i>
                                                        </span> Demo Street 123, Demo City 04312, NJ
                                                    </li>
                                                    <li class='small mb-1'>
                                                        <span class='fa-li'>
                                                            <i class='icon-phone' style='font-size: 1.33333em;line-height: .75em;vertical-align: -.0667em;font-weight:bold;color:#007bff;'></i>
                                                        </span>
                                                        082269777713
                                                    </li>
                                                    <li class='small mb-1'>
                                                        <span class='fa-li'>
                                                            <i class='icon-envelope' style='font-size: 1.33333em;line-height: .75em;vertical-align: -.2667em;font-weight:bold;color:#007bff;'></i>
                                                        </span>
                                                        andiiick@gmail.com
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class='col-5 text-center'>";

                if (empty($key->avatar) && $key->gender == 'L') {
                    $ret .= "<img src='" . base_url() . "'/img/user/avatar.png' class='img-circle img-fluid'>";
                } else if (empty($key->avatar) && $key->gender == 'P') {
                    $ret .= "<img src='" . base_url() . "'/img/user/avatar3.png' class='img-circle img-fluid'>";
                } else if (!empty($key->avatar)) {
                    $ret .= "<img src='" . base_url() . "'/img/user/$key->avatar' class='img-circle img-fluid'>";
                }

                $ret .= "</div>
                                        </div>
                                    </div>
                                    <!-- <div class='card-footer'>
                                        <div class='text-right'>
                                            <a href='#' class='btn btn-sm bg-teal'>
                                                <i class='fas fa-comments'></i>
                                            </a>
                                            <a href='#' class='btn btn-sm btn-primary'>
                                                <i class='fas fa-user'></i> View Profile
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>";
            }

            return $ret;
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------

}

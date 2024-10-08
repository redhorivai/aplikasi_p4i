<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\KtaModel;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;


class Pengguna extends BaseController
{
    protected $m_pengguna;
    protected $m_kta;
    protected $session;
    public function __construct()
    {
        $this->m_pengguna = new PenggunaModel();
        $this->m_kta = new KtaModel();
        $this->date = new DateFunction();
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Data Pengguna',
            'active' => 'pengguna',
        ];
        return view('admin/pengguna/index', $data);
    }
    public function getData()
    {
        $res = $this->m_pengguna->getPengguna();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if (empty($data->avatar) && $data->gender == 'L') {
                    $foto = "<img src='" . base_url() . "/assets-admin/panel/images/users/male.png' class='wd-40 ht-40 rounded-circle'>";
                } else if (empty($data->avatar) && $data->gender == 'P') {
                    $foto = "<img src='" . base_url() . "/assets-admin/panel/images/users/female.png' class='wd-40 ht-40 rounded-circle'>";
                } else {
                    $foto = "<img src='" . base_url() . "/assets-admin/panel/images/users/$data->avatar' class='wd-40 ht-40 rounded-circle'>";
                }
                if ($data->status_acc == 'active') {
                    $status = "<span class='square-8 bg-info rounded-circle'></span> Aktif";
                    $button = "<button type='button' class='btn btn-danger tx-white' onclick='_deactive(\"$data->user_id\",\"$data->name\")'>
                               <i class='icon-user-unfollow'></i>
                               </button>";
                } else {
                    $status = "<span class='square-8 bg-danger rounded-circle'></span> Tidak Aktif";
                    $button = "<button type='button' class='btn btn-info tx-white' onclick='_active(\"$data->user_id\",\"$data->name\")'>
                               <i class='icon-user-following'></i>
                               </button>";
                }
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='user_id[]' class='checkedId' value='$data->user_id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 " . $foto . "
                                 <div class='mg-l-15'>
                                 <div class='tx-inverse'>$data->name</div>
                                 <p class='mb-0 tx-13'>
                                 <b>Username</b> <b>:</b> $data->username
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:25px;'>Akses</b> <b>:</b> $data->level
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:24px;'>Status</b> <b>:</b> $status
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                <button type='button' class='btn btn-warning tx-white' onclick='_digital_kta(\"$data->user_id\")'>
                                 <i class='icon-book-open'></i>
                                 </button>
                                 " . $button . "
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->user_id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_resetPassword(\"$data->user_id\",\"$data->name\")'>
                                 <i class='icon-lock-open'></i> <span style='vertical-align:text-top;'>Reset Password</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->user_id\",\"$data->name\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
                );
                $ret = array('data' => $output);
            }
        } else {
            $ret = array('data' => []);
        }
        return $this->response->setJSON($ret);
    }
    public function form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            if ($id == "") {
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Tambah Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                $ret .= "
                <form class='form-data form-layout-1'>
                    <div class='row'>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Nama: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='name' name='name' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Username: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='username' name='username' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>e-Mail: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='email' name='email' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>NIK: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='nik' name='nik' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Tempat Lahir: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='tempat_lahir' name='tempat_lahir' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Tanggal Lahir: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='date' id='tanggal_lahir' name='tanggal_lahir' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Telepon: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='phone' name='phone' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Jenis Kelamin: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='gender' name='gender' data-placeholder='-- Pilih Jenis Kelamin --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='L'>Laki-Laki</option>
                        <option value='P'>Perempuan</option>
                        </select>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Level Akses: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='level' name='level' data-placeholder='-- Pilih Level Akses --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='Super User'>Super User</option>
                        <option value='Admin'>Admin</option>
                        <option value='User'>User</option>
                        </select>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-8'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Alamat:</label>
                        <textarea rows='3' id='address' name='address' class='form-control'></textarea>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class='form-layout-footer text-center mg-t-20'>
                    <button type='button' class='btn btn-info' onclick='_simpan()'>Simpan</button>
                    <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                    </div>
                </form>";
                $ret .= "<script>
                         $('.select2').select2();
                         $('#btnCancelForm').click(function() {
                            $('.form-data')[0].reset();
                            $('#name').removeClass('is-invalid');
                            $('#username').removeClass('is-invalid');
                            $('#email').removeClass('is-invalid');
                            $('#phone').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_pengguna->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1'>  
                        <div class='row'>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Nama: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='name' name='name' value='$key->name' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Username: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='username' name='username' value='$key->username' readonly>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>e-Mail: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='email' name='email' value='$key->email' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>NIK: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='nik' name='nik' value='$key->nik' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Tempat Lahir: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='tempat_lahir' name='tempat_lahir' value='$key->tempat_lahir' readonly>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Tanggal Lahir: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='tanggal_lahir' name='tanggal_lahir' value='$key->tanggal_lahir' onchange='remove(id)'>
                            </div>
                        </div>
                        </div
                        </div>
                        <div class='row'>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Telepon: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='phone' name='phone' value='$key->phone' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Jenis Kelamin: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='gender' name='gender' data-placeholder='-- Pilih Jenis Kelamin --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value='L' " . ($key->gender == "L" ? "selected='selected'" : "") . ">Laki-Laki</option>
                            <option value='P' " . ($key->gender == "P" ? "selected='selected'" : "") . ">Perempuan</option>
                            </select>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Level Akses: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='level' name='level' data-placeholder='-- Pilih Level Akses --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value='Super User' " . ($key->level == "Super User" ? "selected='selected'" : "") . ">Super User</option>
                            <option value='Admin' " . ($key->level == "Admin" ? "selected='selected'" : "") . ">Admin</option>
                            <option value='User' " . ($key->level == "User" ? "selected='selected'" : "") . ">User</option>
                            </select>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-8'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Alamat:</label>
                            <textarea rows='3' id='address' name='address' class='form-control'>$key->address</textarea>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->user_id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                             $('.select2').select2();
                             $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#name').removeClass('is-invalid');
                                $('#username').removeClass('is-invalid');
                                $('#email').removeClass('is-invalid');
                                $('#phone').removeClass('is-invalid');
                                $('#formData').addClass('d-none');
                                $('#viewData').delay(100).fadeIn();
                              });
                             </script>";
                    return $ret;
                }
            }
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $name     = $this->request->getPost('name');
            $username = strtolower($this->request->getPost('username'));
            $nik   = $this->request->getPost('nik');
            $tempat_lahir    = $this->request->getPost('tempat_lahir');
            $tanggal_lahir    = $this->request->getPost('tanggal_lahir');
            $gender   = $this->request->getPost('gender');
            $email    = $this->request->getPost('email');
            $phone    = $this->request->getPost('phone');
            $level    = $this->request->getPost('level');
            $address  = $this->request->getPost('address');
            $data = [
                'name'         => $name,
                'username'     => $username,
                'nik'          => $nik,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'gender'       => $gender,
                'email'        => $email,
                'phone'        => $phone,
                'level'        => $level,
                'address'      => $address,
                'password'     => sha1(md5('123456')),
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_pengguna->insertData($data);
            if ($insert == true) {
                $msg = "Sukses";
            } else {
                $msg = "Username: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id       = $this->request->getPost('id');
            $name     = $this->request->getPost('name');
            $username = strtolower($this->request->getPost('username'));
            $nik   = $this->request->getPost('nik');
            $tempat_lahir    = $this->request->getPost('tempat_lahir');
            $tanggal_lahir    = $this->request->getPost('tanggal_lahir');
            $gender   = $this->request->getPost('gender');
            $email    = $this->request->getPost('email');
            $phone    = $this->request->getPost('phone');
            $level    = $this->request->getPost('level');
            $address  = $this->request->getPost('address');
            $data = [
                'name'         => $name,
                'username'     => $username,
                'nik'          => $nik,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'gender'       => $gender,
                'email'        => $email,
                'phone'        => $phone,
                'level'        => $level,
                'address'      => $address,
                'updated_user' => session()->get('user_id'),
                'updated_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_pengguna->updateData($id, $data);
            if ($update == true) {
                $msg = "Sukses";
            } else {
                $msg = "Username: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    public function active()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $data = ['status_acc' => 'active'];
            $this->m_pengguna->updateData($id, $data);
            $msg = ['sukses' => 'Aktivasi akun user telah dilakukan.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function deactive()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $data = ['status_acc' => 'deactive'];
            $this->m_pengguna->updateData($id, $data);
            $msg = ['sukses' => 'Akun user telah di non-aktifkan.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_pengguna->updateData($id, $data);
            $msg = ['sukses' => 'Data user telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function reset_password()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $data = ['password' => sha1(md5('123456')),];
            $this->m_pengguna->updateData($id, $data);
            $msg = ['sukses' => 'Atur ulang kata sandi berhasil.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('user_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++) {
                $data = [
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_pengguna->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> ' . $jmldata . ' data</b> pengguna telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function digital_kta()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('user_id');
            print_r($id);
            // $user_id      = session()->get('user_id');
            $ekta = $this->m_kta->getIDKta($id);
            // print_r($ekta);

            $ret = "";
            $no = 1;
            foreach ($ekta as $key) {
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header' style='margin-bottom:30px;'>
                         <h5 class='text-center text-dark w-100'><b>".$key->name."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
                         </div>
                         <div class='col-md-6'>
                            <div class='card-dokter'>
                                <img src='".base_url()."/assets-admin/panel/images/kta/kta_card.jpg' style='width:235%'>
                                <div id='card_id' style='position: fixed;left: 230px;font-size: 18px;color: #000;top: 229px;font-weight: 500;'>$key->no_anggota</div>
                                <div id='card_id' style='position: fixed;left: 230px;font-size: 18px;color: #000;top: 255px;font-weight: 500;'>$key->name</div>
                                <div id='card_id' style='position: fixed;left: 230px;font-size: 16px;color: #000;top: 285px;font-weight: 500;'>$key->address</div>
                                <div id='card_id' style='position: fixed;left: 230px;font-size: 18px;color: #000;top: 329px;font-weight: 500;'>$key->cabang</div>
                          <img src='".base_url()."/assets-front/images/logo/$key->photo' style='max-height: 100%;max-width:170px;position:fixed;top:225px;left:552px; '>
                            </div>
                          </div>
                         <div class='modal-footer'>
                         <button type='button' class='btn btn-block btn-light' data-dismiss='modal' style='font-size:11px;'>Tutup
                         </button>
                         </div>
                         </div>
                         </div>";
                         
            }
            return $ret;
        } else {
            exit('Request Error');
        }
    }
}

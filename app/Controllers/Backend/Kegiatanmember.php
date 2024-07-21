<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\KegiatanMemberModel;
use App\Libraries\Date\DateFunction;


class Kegiatanmember extends BaseController
{
    protected $m_kegiatanmember;
    protected $session;
    public function __construct()
    {
        $this->m_kegiatanmember = new KegiatanMemberModel();
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
            'title'  => 'Data Agenda Kegiatan',
            'active' => 'kegiatanmember',
        ];
        return view('admin/kegiatanmember/index', $data);
    }
    public function getData()
    {
        $res = $this->m_kegiatanmember->getAgenda();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if ($data->status_join == 'y') {
                    $status = 'Anggota';
                } else {
                    $status = 'Bukan Anggota';
                }
                
                $judul = strtoupper($data->nama);
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 <div class='mg-l-15'>
                                 <div class='tx-inverse'><strong>$judul</strong></div>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:70px;'>Nama</b> <b>:</b> $data->name
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:16px;'>Tanggal Daftar</b> <b>:</b> ".$this->date->panjang($data->created_dttm)."
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:0px;'>Periode Kegiatan</b> <b> :</b> ".$this->date->panjang($data->start_date) . " / " . $this->date->panjang($data->end_date)."
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:67px;'>Status</b> <b>:</b> $status
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
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
            $res = $this->m_kegiatanmember->getIdKegiatan();
            foreach ($res as $key) {
                $start_ped = $this->date->panjang($key->start_date);
                $end_ped = $this->date->panjang($key->end_date);
                $opt .= "<option value='$key->id'>$key->nama ( $start_ped / $end_ped ) </option>";
            }
            if ($id == "") {
                $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Daftar</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                csrf_field();
                $ret .= "
                <form class='form-data form-layout-1'>
                    <div class='row'>
                    <div class='col-lg-8'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Kegiatan Seminar: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='id_kegiatan' name='id_kegiatan' data-placeholder='-- Pilih Jenis Kegiatan --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        $opt
                        </select>
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
                            $('#id_kegiatan').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            }
        } else {
            exit('Request Error');
        }
    }
    public function insert_data()
    {
        if ($this->request->isAJAX()) {
            $id_kegiatan     = $this->request->getPost('id_kegiatan');
            $data = [
                'id_user'      => session()->get('user_id'),
                'id_kegiatan'  => $id_kegiatan,
                'status_join'  => 'y',
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_kegiatanmember->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Nama: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    // public function update_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id       = $this->request->getPost('id');
    //         $name     = $this->request->getPost('name');
    //         $username = strtolower($this->request->getPost('username'));
    //         $gender   = $this->request->getPost('gender');
    //         $email    = $this->request->getPost('email');
    //         $phone    = $this->request->getPost('phone');
    //         $level    = $this->request->getPost('level');
    //         $address  = $this->request->getPost('address');
    //         $data = [
    //             'name'         => $name,
    //             'username'     => $username,
    //             'gender'       => $gender,
    //             'email'        => $email,
    //             'phone'        => $phone,
    //             'level'        => $level,
    //             'address'      => $address,
    //             'updated_user' => session()->get('user_id'),
    //             'updated_dttm' => date('Y-m-d H:i:s'),
    //         ];
    //         $update = $this->m_pengguna->updateData($id, $data);
    //         if ($update == true) {    
    //             $msg = "Sukses";
    //         } else {
    //             $msg = "Username: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain.";
    //         }
    //         return $msg;
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function active()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['status_acc' => 'active'];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Aktivasi akun user telah dilakukan.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function deactive()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['status_acc' => 'deactive'];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Akun user telah di non-aktifkan.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function del_data()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = [
    //             'nullified_user' => session()->get('user_id'),
    //             'nullified_dttm' => date('Y-m-d H:i:s'),
    //             'status_cd'      => 'nullified',
    //         ];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Data user telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function reset_password()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $data = ['password' => sha1(md5('123456')),];
    //         $this->m_pengguna->updateData($id, $data);
    //         $msg = ['sukses' => 'Atur ulang kata sandi berhasil.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
    // public function multi_del()
    // {
    //     if ($this->request->isAJAX()) {
    //         $id = $this->request->getPost('user_id');
    //         $jmldata = count($id);
    //         for ($i = 0; $i < $jmldata; $i++){
    //             $data = [
    //                 'nullified_user' => session()->get('user_id'),
    //                 'nullified_dttm' => date('Y-m-d H:i:s'),
    //                 'status_cd'      => 'nullified',
    //             ];
    //             $this->m_pengguna->updateData($id[$i], $data);
    //         }
    //         $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> pengguna telah dihapus.'];
    //         echo json_encode($msg);
    //     } else {
    //         exit('Request Error');
    //     }
    // }
}
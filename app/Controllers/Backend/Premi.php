<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\PremiModel;
use App\Libraries\Date\DateFunction;

class Premi extends BaseController
{
    protected $m_premi;
    protected $session;
    public function __construct()
    {
        $this->m_premi  = new PremiModel();
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
            'title'  => 'Premi/Iuran',
            'active' => 'premi',
        ];
        return view('admin/premi/index', $data);
    }
    public function getData()
    {
        $user_id = session()->get('user_id');
        $res = $this->m_premi->getPremi($user_id);
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                    if ($data->status_iuran == 'lunas') {
                        $ket_iuran = "<span class='square-8 bg-info rounded-circle'></span> Lunas";
                    } else {
                        $ket_iuran = "<span class='square-8 bg-danger rounded-circle'></span> Belum Lunas";
                    }
                
                if ($data->status_cd == 'normal') {
                    $icon_upload = "<img src='".base_url()."/assets-admin/panel/images/bukti-premi/$data->path' class='wd-40 ht-40rounded-circle'>";
                } else {
                    $icon_upload = "<img src='".base_url()."/assets-admin/panel/images/icon-upload.jpg' class='wd-40 ht-40rounded-circle'>";
                }

                $ket = strtoupper($data->keterangan);


                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 ".$icon_upload."
                                 <div class='mg-l-15'>
                                 <p class='mb-0 tx-13'>
                                 <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$ket</a>
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:8px;'>Nama</b> <b>:</b> $data->name
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:5px;'>Status</b> <b>:</b> $ket_iuran
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>	  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\")'>
                                 <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                                 </a>
                                 </nav>
                                 </div>
                                 </div>",
                );
                $ret = array(
                    'data' => $output,
                );
            }
        } else {
            $ret = array(
                'data' => [],
            );
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
                <form class='form-data form-layout-1 forms'>
                    <div class='row text-center'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Keterangan: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='keterangan' name='keterangan' class='form-control' onchange='remove(id)'></textarea>
                        </div>
                    </div>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Upload Bukti Pembayaran:</label>
                        <div class='fileinput fileinput-new' data-provides='fileinput'>
                            <div class='fileinput-new thumbnail'>
                            <img src='".base_url()."/assets-admin/panel/images/1080x650.png'>
                            </div>
                            <div class='fileinput-preview fileinput-exists thumbnail'></div>
                            <div class='tx-center'>
                            <span class='btn btn-sm btn-outline-info btn-file' style='cursor:pointer;'>
                            <span class='fileinput-new' style='padding-left:30px;padding-right:30px;'>Browse File</span>
                            <span class='fileinput-exists mr-1'>Change</span>
                                <input type='file' name='path' id='path'>
                            </span>
                            <a href='#' class='btn btn-sm btn-outline-danger fileinput-exists' data-dismiss='fileinput' style='cursor:pointer;'>Remove</a>
                            </div>
                        </div>
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
                         $('#btnCancelForm').click(function() {
                            $('.form-data')[0].reset();
                            $('#keterangan').removeClass('is-invalid');
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
            $keterangan = $this->request->getPost('keterangan');
            $path = $this->request->getFile('path');
            if ($path == "") {
                $data_path = '800x600.png';
            } else {
                $data_path = $path->getRandomName();
                $path->move('assets-admin/panel/images/bukti-premi', $data_path);
            }
            $data = [
                'keterangan'      => $keterangan,
                'id_user'         => session()->get('user_id'),
                'path'            => $data_path,
                'status_iuran'    => 'lunas',
                'status_cd'       => 'normal',
                'created_user'    => session()->get('user_id'),
                'created_dttm'    => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_premi->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Terjadi kesalahan!, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_premi->updateData($id, $data);
            $msg = ['sukses' => 'Bukti Bayar telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_premi->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> Bukti Bayar telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $user_id = session()->get('user_id');
            $id      = $this->request->getPost('id');
            $kegiatan = $this->m_premi->getDetail($id, $user_id);


            $ret = "";
            $no = 1;
            foreach ($kegiatan as $key) {

                        $tggl_regis = $this->date->pendek($key->created_dttm);
                        $thn = explode('-', $tggl_regis);
                        $no_kta = $key->id_user."-KTA P4I/".$tggl_regis;

                        $ret .= "<div class='modal-dialog modal-lg' role='document'>
                        <div class='modal-content'>
                        <div class='modal-header'>
                        <h5 class='text-center text-dark w-100'><b>".$key->keterangan."</b></h5>
                        </div>
                        <div class='modal-body'>
                        <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
                        <div class='row'>
                        <div class='col-md-8'>
                        <img src='".base_url()."/assets-admin/panel/images/bukti-premi/".$key->path."' class='w-100' style='border:2px solid #CCC;'>
                        </div>
                        <div class='col-md-4'>
                        <p>$key->name ($no_kta)</p>
                        </div>
                        </div>
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
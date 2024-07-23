<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\InfoModel;
use App\Libraries\Date\DateFunction;

class FAQ extends BaseController
{
    protected $m_info;
    protected $session;
    public function __construct()
    {
        $this->m_info = new InfoModel();
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
            'title'  => 'Frequently Ask & Question',
            'active' => 'faq',
        ];
        return view('admin/faq/index', $data);
    }
    public function getData()
    {
        $res = $this->m_info->getByTypeLimit('faq', 0);
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='info_id[]' class='checkedId' value='$data->info_id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <a href='javascript:void(0)' class='tx-inverse tx-14 tx-medium d-block'><b>Q:</b> $data->info_title</a>
                                <span class='tx-13 d-block'><span class='tx-inverse tx-14 tx-medium'><b>A:</b></span> $data->info_desc</span>
                                <span class='tx-13'>Admin | ".$this->date->panjang($data->created_dttm)."</span>
                                </div>
                                </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->info_id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->info_id\",\"$data->info_title\")'>
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
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Pertanyaan: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='info_title' name='info_title' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Jawaban: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='info_desc' name='info_desc' class='form-control'></textarea>
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
                            $('#info_title').removeClass('is-invalid');
                            $('#info_desc').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_info->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Pertanyaan: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='info_title' name='info_title' value='$key->info_title' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Jawaban: <span class='tx-danger'>*</span></label>
                            <textarea rows='5' id='info_desc' name='info_desc' class='form-control'>$key->info_desc</textarea>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->info_id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                            $('.select2').select2();
                            $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#info_title').removeClass('is-invalid');
                                $('#info_desc').removeClass('is-invalid');
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
            $info_title = ucwords($this->request->getPost('info_title'));
            $info_desc  = $this->request->getPost('info_desc');
            $data = [
                'info_kat'     => 'hak_kewajiban',
                'info_title'   => ucwords($info_title),
                'info_desc'    => $info_desc,
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_info->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Pertanyaan: <b class='text-danger'>$info_title</b> sudah ada, silahkan coba yang lain.";
            }
        } else {
            $msg = [
                "error" => "Request Error",
            ];
        }
        echo json_encode($msg);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id         = $this->request->getPost('id');
            $info_title = ucwords($this->request->getPost('info_title'));
            $info_desc  = $this->request->getPost('info_desc');
            $data = [
                'info_title'   => ucwords($info_title),
                'info_desc'    => $info_desc,
                'status_cd'    => 'normal',
                'updated_user' => session()->get('user_id'),
                'updated_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_info->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Pertanyaan: <b class='text-danger'>$info_title</b> sudah ada, silahkan coba yang lain.";
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
            $id = $this->request->getPost('info_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_info->updateData($id, $data);
            $msg = ['sukses' => 'Data FAQ telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('info_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_info->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> FAQ telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
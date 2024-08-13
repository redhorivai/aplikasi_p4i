<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\PenggunaModel;
use App\Libraries\Date\DateFunction;
use App\Models\Backend\EdukasiModel;

class Edukasi extends BaseController
{
    protected $m_edukasi;
    protected $m_pengguna;
    protected $session;
    public function __construct()
    {
        $this->m_edukasi  = new EdukasiModel();
        $this->m_pengguna = new PenggunaModel();
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
            'title'  => 'Edukasi',
            'active' => 'edukasi',
        ];
        return view('admin/edukasi/index', $data);
    }
    public function getData()
    {
        $res = $this->m_edukasi->getEdukasi();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $user = $this->m_pengguna->getByID($data->created_user);
                foreach ($user as $res) {
                    $admin = $res->name;
                }
                if ($data->type == "edukasi") {
                    $type = "Edukasi";
                } elseif ($data->type == "artikel") {
                    $type = "Artikel";
                } else {
                    $type = "Berita";
                }
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='artikel_id[]' class='checkedId' value='$data->artikel_id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                <img src='" . base_url() . "/assets-admin/panel/images/youtube.png' class='wd-55'>
                                <div class='mg-l-15'>
                                <span class='tx-13'>" . $type . "</span>
                                <a href='javascript:void(0)' onclick='_detail(\"$data->artikel_id\")' class='tx-inverse tx-14 tx-medium d-block'>$data->title</a>
                                <span class='tx-13'>$admin | " . $this->date->panjang($data->created_dttm) . "</span>
                                </div>
                                </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->artikel_id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>			  
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->artikel_id\",\"$data->title\")'>
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
                    <div class='col-lg-3'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Kategori: <span class='tx-danger'>*</span></label>
                        <select class='form-control select2' id='type' name='type' data-placeholder='-- Pilih Kategori --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                        <option value=''></option>
                        <option value='edukasi'>Edukasi</option>
                        </select>
                        </div>
                    </div>
                    <div class='col-lg-5'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='title' name='title' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-4'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Link Edukasi: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='path_edukasi' name='path_edukasi' onchange='remove(id)'>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Isi/Deskripsi: <span class='tx-danger'>*</span></label>
                        <textarea rows='5' id='description' name='description' class='form-control' onchange='remove(id)'></textarea>
                        </div>
                    </div>
                    </div>
                    <div class='row tx-center'>";
                $ret .= "</div>
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
                            $('#title').removeClass('is-invalid');
                            $('#path_edukasi').removeClass('is-invalid');
                            $('#description').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_edukasi->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1 forms'>
                        <div class='row'>
                        <div class='col-lg-3'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Kategori: <span class='tx-danger'>*</span></label>
                            <select class='form-control select2' id='type' name='type' data-placeholder='-- Pilih Kategori --' data-allow-clear='true' style='width:100%' onchange='remove(id)'>
                            <option value=''></option>
                            <option value='edukasi' " . ($key->type == "edukasi" ? "selected='selected'" : "") . ">Edukasi</option>
                            </select>
                            </div>
                        </div>
                        <div class='col-lg-5'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='title' name='title' value='$key->title' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='path_edukasi' name='path_edukasi' value='$key->path_edukasi' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-12'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Isi/Deskripsi: <span class='tx-danger'>*</span></label>
                            <textarea rows='5' id='description' name='description' class='form-control'>" . $key->description . "</textarea>
                            </div>
                        </div>
                        </div>
                        <div class='row tx-center'>";
                    $ret .= "</div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->artikel_id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                            $('.select2').select2();
                            $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#title').removeClass('is-invalid');
                                $('#description').removeClass('is-invalid');
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
            $type        = $this->request->getPost('type');
            $title       = ucwords($this->request->getPost('title'));
            $path_edukasi = $this->request->getPost('path_edukasi');
            $description = $this->request->getPost('description');

            $data = [
                'type'         => $type,
                'title'        => ucwords($title),
                'path_edukasi' => $path_edukasi,
                'description'  => $description,
                'status_cd'    => 'normal',
                'created_user' => session()->get('user_id'),
                'created_dttm' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_edukasi->insertData($data);
            if ($insert == true) {
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$title</b> sudah ada, silahkan coba yang lain.";
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
            $id          = $this->request->getPost('id');
            $type        = $this->request->getPost('type');
            $title       = ucwords($this->request->getPost('title'));
            $path_edukasi= $this->request->getPost('path_edukasi');
            $description = $this->request->getPost('description');

            $data = [
                'type'         => $type,
                'title'        => ucwords($title),
                'path_edukasi' => $path_edukasi,
                'description'  => $description,
                'status_cd'    => 'normal',
                'updated_user' => session()->get('user_id'),
                'updated_dttm' => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_edukasi->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Judul: <b class='text-danger'>$title</b> sudah ada, silahkan coba yang lain.";
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
            $id = $this->request->getPost('artikel_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'      => 'nullified',
            ];
            $this->m_edukasi->updateData($id, $data);
            $msg = ['sukses' => 'Edukasi telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function multi_del()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('artikel_id');
            $jmldata = count($id);
            for ($i = 0; $i < $jmldata; $i++){
                $data = [
                    'nullified_user' => session()->get('user_id'),
                    'nullified_dttm' => date('Y-m-d H:i:s'),
                    'status_cd'      => 'nullified',
                ];
                $this->m_edukasi->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> edukasi telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('artikel_id');
            $artikel = $this->m_edukasi->getByID($id);

            $ret = "";
            $no = 1;
            foreach ($artikel as $key) {
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header'>
                         <h5 class='text-center text-dark w-100'><b>".$key->title."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
                         </div>
                         <div class='modal-body'>
                          <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
                         '<embed src='$key->path_edukasi' width='720px' height='330px' allowfullscreen />'
                         </div>
                         <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
                         ".$key->description."
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

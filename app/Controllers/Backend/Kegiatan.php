<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\KegiatanModel;
use App\Libraries\Date\DateFunction;

class Kegiatan extends BaseController
{
    protected $m_kegiatan;
    protected $session;
    public function __construct()
    {
        $this->m_kegiatan = new KegiatanModel();
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
            'active' => 'kegiatan',
        ];
        return view('admin/kegiatan/index', $data);
    }
    public function getData()
    {
        $res = $this->m_kegiatan->getKegiatan();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if ($data->status_acc == 'active') {
                    $status = "<span class='square-8 bg-info rounded-circle'></span> Aktif";
                    $button = "<button type='button' class='btn btn-danger tx-white' onclick='_deactive(\"$data->id\",\"$data->nama\")'>
                               <i class='fa fa-times'></i>
                               </button>";
                } else {
                    $status = "<span class='square-8 bg-danger rounded-circle'></span> Tidak Aktif";
                    $button = "<button type='button' class='btn btn-info tx-white' onclick='_active(\"$data->id\",\"$data->nama\")'>
                               <i class='fa fa-check'></i>
                               </button>";
                }
                $judul = strtoupper($data->nama);
                $output[] = array(
                    'cek'   => "<div class='valign-middle'>
                                <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                </label>
                                </div>",
                    'col'   => "<div class='d-flex align-items-center'>
                                 <div class='mg-l-15'>
                                 <p class='mb-0 tx-13'>
                                 <a href='javascript:void(0)' onclick='_detail(\"$data->id\")' class='tx-inverse tx-14 tx-medium d-block'>$judul</a>
                                 </p>
                                 <p class='mb-0 tx-13'>
                                 <b style='margin-right:8px;'>Status</b> $status
                                 </p>
                                 <p class='mb-0 tx-13'> Periode | " . $this->date->panjang($data->start_date) . " - " . $this->date->panjang($data->end_date) ."
                                 </p>
                                 </div>
                                 </div>",
                    'action' => "<div class='dropdown tx-center'>
                                 ".$button."
                                 <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                                 <i class='icon-grid' style='vertical-align:inherit;'></i>
                                 </a>		
                                 <div class='dropdown-menu dropdown-menu-right pd-10'>
                                 <nav class='nav nav-style-2 flex-column'>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_btnEdit($data->id)'>
                                 <i class='icon-note'></i> <span style='vertical-align:text-top;'>Perubahan</span>
                                 </a>
                                 <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->nama\")'>
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
                        <label class='form-control-label tx-bold'>Judul: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='text' id='nama' name='nama' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-8'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Keterangan: <span class='tx-danger'>*</span></label>
                        <textarea rows='3' id='keterangan' name='keterangan' class='form-control'></textarea>
                        </div>
                    </div>
                    </div>
                    <div class='row'>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Periode Mulai: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='date' id='start_date' name='start_date' onchange='remove(id)'>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='form-group'>
                        <label class='form-control-label tx-bold'>Periode Akhir: <span class='tx-danger'>*</span></label>
                        <input class='form-control' type='date' id='end_date' name='end_date' onchange='remove(id)'>
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
                            $('#nama').removeClass('is-invalid');
                            $('#keterangan').removeClass('is-invalid');
                            $('#start_date').removeClass('is-invalid');
                            $('#end_date').removeClass('is-invalid');
                            $('#formData').addClass('d-none');
                            $('#viewData').delay(100).fadeIn();
                          });
                         </script>";
                return $ret;
            } else {
                $res = $this->m_kegiatan->getByID($id);
                foreach ($res as $key) {
                    $ret = "<div class='br-section-wrapper'><h6 class='tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-0'>Form Update Data</h6><p class='mg-b-20 tx-12 tx-gray-600'>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</p>";
                    csrf_field();
                    $ret .= "
                    <form class='form-data form-layout-1'>  
                        <div class='row'>
                        <div class='col-lg-4'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Nama: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='text' id='nama' name='nama' value='$key->nama' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-8'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Keterangan: <span class='tx-danger'>*</span></label>
                            <textarea rows='3' id='keterangan' name='keterangan' class='form-control'>$key->keterangan</textarea>
                            </div>
                        </div>
                        </div>
                        <div class='row'>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Periode Mulai: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='date' id='start_date' name='start_date' value='$key->start_date' onchange='remove(id)'>
                            </div>
                        </div>
                        <div class='col-lg-6'>
                            <div class='form-group'>
                            <label class='form-control-label tx-bold'>Periode Akhir: <span class='tx-danger'>*</span></label>
                            <input class='form-control' type='date' id='end_date' name='end_date' value='$key->end_date' onchange='remove(id)'>
                            </div>
                        </div>
                        </div>
                        <hr>
                        <div class='form-layout-footer text-center mg-t-20'>
                        <button type='button' class='btn btn-success' onclick='_update($key->id)'>Update</button>
                        <button type='button' class='btn btn-light' id='btnCancelForm'>Batal</button>
                        </div>
                    </form>";
                    $ret .= "<script>
                             $('.select2').select2();
                             $('#btnCancelForm').click(function() {
                                $('.form-data')[0].reset();
                                $('#nama').removeClass('is-invalid');
                                $('#kegiatan').removeClass('is-invalid');
                                $('#start_date').removeClass('is-invalid');
                                $('#end_date').removeClass('is-invalid');
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
            $nama         = $this->request->getPost('nama');
            $keterangan   = $this->request->getPost('keterangan');
            $start_date   = $this->request->getPost('start_date');
            $end_date     = $this->request->getPost('end_date');
            $data = [
                'nama'          => $nama,
                'keterangan'    => $keterangan,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'created_user'  => session()->get('user_id'),
                'created_dttm'  => date('Y-m-d H:i:s'),
            ];
            $insert = $this->m_kegiatan->insertData($data);
            if ($insert == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Kegiatan: <b class='text-danger'>$start_date</b> sudah ada, silahkan coba periode yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id           = $this->request->getPost('id');
            $nama         = $this->request->getPost('nama');
            $keterangan   = $this->request->getPost('keterangan');
            $start_date   = $this->request->getPost('start_date');
            $end_date     = $this->request->getPost('end_date');
            $data = [
                'nama'          => $nama,
                'keterangan'    => $keterangan,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'updated_user'  => session()->get('user_id'),
                'updated_dttm'  => date('Y-m-d H:i:s'),
            ];
            $update = $this->m_kegiatan->updateData($id, $data);
            if ($update == true) {    
                $msg = "Sukses";
            } else {
                $msg = "Kegiatan: <b class='text-danger'>$start_date</b> sudah ada, silahkan coba periode yang lain.";
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }
    public function active()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = ['status_acc' => 'active'];
            $this->m_kegiatan->updateData($id, $data);
            $msg = ['sukses' => 'Aktivasi kegiatan telah dilakukan.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function deactive()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = ['status_acc' => 'deactive'];
            $this->m_kegiatan->updateData($id, $data);
            $msg = ['sukses' => 'Kegiatan telah di non-aktifkan.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
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
            $this->m_kegiatan->updateData($id, $data);
            $msg = ['sukses' => 'Data kegiatan telah dihapus.'];
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
                $this->m_kegiatan->updateData($id[$i], $data);
            }
            $msg = ['sukses' => '<b style="margin-left:10px;"> '.$jmldata.' data</b> kegiatan telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $kegiatan = $this->m_kegiatan->getByID($id);

            $ret = "";
            $no = 1;
            foreach ($kegiatan as $key) {
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header'>
                         <h5 class='text-center text-dark w-100'><b>".$key->nama."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
                         </div>
                         <div class='modal-body'>
                         <div class='bd rounded table-responsive table-hover' style='overflow-y:scroll;max-height:406px;padding:20px;'>
                         ".$key->keterangan."
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
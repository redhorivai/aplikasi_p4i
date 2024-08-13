<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\LayananModel;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\fpdf;
use CodeIgniter\CLI\Console;

class Saran extends BaseController
{
    protected $m_layanan;
    protected $session;
    public function __construct()
    {
        $this->m_layanan = new LayananModel();
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
            'title'  => 'Data Saran',
            'active' => 'saran',
        ];
        return view('admin/saran/index', $data);
    }
    public function getData()
    {
        $res = $this->m_layanan->getSaran();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                if (session()->get('level') == 'Super User') {
                    $checkbox = "<div class='valign-middle'>
                                 <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='lapor_id[]' class='checkedId' value='$data->id'><span></span>
                                 </label>
                                 </div>";
                    $button = "<div class='dropdown tx-center'>
                               <a href='javascript:void(0);' data-toggle='dropdown' class='btn btn-outline-secondary tx-gray'>
                               <i class='icon-grid' style='vertical-align:inherit;'></i>
                               </a>		
                               <div class='dropdown-menu dropdown-menu-right pd-10'>
                               <nav class='nav nav-style-2 flex-column'>			  
                               <a href='javascript:void(0);' class='nav-link' onclick='_delData(\"$data->id\",\"$data->nama\")'>
                               <i class='icon-trash'></i> <span style='vertical-align:text-top;'>Hapus</span>
                               </a>
                               </nav>
                               </div>
                               </div>";
                } else {
                    $checkbox = "<div class='valign-middle tx-center tx-dark'>".$nomor++.".</div>";
                    $button = "";
                }
                $output[] = array(
                    'cek'   => "".$checkbox."",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <span class='tx-13'><b>".$this->date->panjang($data->lapor_dttm)."</b></span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Nama<span style='margin-left:21px;'>:</span></b> $data->nama</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>e-Mail<span style='margin-left:20px;'>:</span></b> $data->email</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Telepon<span style='margin-left:7px;'>:</span></b> $data->telepon</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Pertanyaan<span style='margin-left:19px;'>:</span></b> $data->pesan</span>
                                </div>
                                </div>",
                    'action' => "".$button."",
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
    public function del_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = [
                'status_cd' => 'nullified',
            ];
            $this->m_layanan->softDelSaran($id, $data);
            $msg = ['sukses' => 'Data Saran telah dihapus.'];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
}
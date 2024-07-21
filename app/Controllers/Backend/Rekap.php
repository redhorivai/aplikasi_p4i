<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Backend\RekapModel;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\fpdf;

class Rekap extends BaseController
{
    protected $m_rekap;
    protected $session;
    public function __construct()
    {
        $this->m_rekap = new RekapModel();
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
            'title'  => 'Data Pengaduan',
            'active' => 'rekapkegiatan',
        ];
        return view('admin/rekap/index', $data);
    }
    public function rekap_premi()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/panel'));
        }
        $data = [
            'title'  => 'Report Pengaduan',
            'active' => 'rekappremi',
        ];
        return view('admin/rekap/report', $data);
    }
    public function getData()
    {
        $res = $this->m_rekap->getRekapkegiatan();
        $nomor = 1;
        if (count($res) > 0) {
            foreach ($res as $data) {
                $start = $this->date->panjang($data->start_date);
                $end = $this->date->panjang($data->end_date);
                if (session()->get('level') == 'Super User') {
                    $checkbox = "<div class='valign-middle'>
                                 <label class='ckbox mg-b-0' style='cursor:pointer;margin-left:5px;'>
                                    <input type='checkbox' name='id[]' class='checkedId' value='$data->id'><span></span>
                                 </label>
                                 </div>";
                    $button = "<div class='dropdown tx-center'>
                               </div>";
                } else {
                    $checkbox = "<div class='valign-middle tx-center tx-dark'>".$nomor++.".</div>";
                    $button = "";
                }
                $output[] = array(
                    'cek'   => "",
                    'col'   => "<div class='d-flex align-items-center'>
                                <div class='mg-l-15'>
                                <span class='tx-13'><b>".$this->date->panjang($data->created_dttm)."</b></span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Nama<span style='margin-left:58px;'>:</span></b> $data->nama</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Keterangan<span style='margin-left:20px;'>:</span></b> $data->keterangan</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Periode Mulai<span style='margin-left:6px;'>:</span></b> $start</span>
                                <span class='tx-inverse tx-14 tx-medium d-block'><b>Periode Akhir<span style='margin-left:8px;'>:</span></b> $end</span>
                                </div>
                                </div>",
                    'action' => "",
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

    public function view_report()
    {
        if ($this->request->isAJAX()) {
            $tglAwal  = $this->request->getPost('tglAwal');
            $tglAkhir = $this->request->getPost('tglAkhir');
            $res = $this->m_rekap->getLaporByTgl($tglAwal, $tglAkhir);
            $ret = "<div class='br-section-wrapper'>
                    <h6 class='tx-gray-800 tx-center tx-uppercase tx-bold mg-b-0'>Report Premi Anggota P4i</h6>
                    <h6 class='mg-b-20 tx-gray-600 tx-center tx-bold'>Periode: <b class='text-danger'>".$this->date->panjang($tglAwal)."</b> - <b class='text-danger'>".$this->date->panjang($tglAkhir)."</b></h6><hr>";
                
                $ret .= "<table class='table table-bordered tx-dark'>
                         <thead style='background-color:rgba(214, 217, 218, 0.2)'>
                         <tr>
                         <th>Nama</th>
                         <th>Keterangan</th>
                         <th>Status</th>
                         <th>Bukti</th>
                         </tr>
                         </thead>
                         <tbody>";
                if (count($res) > 0) {
                    foreach ($res as $data) {
                        $stat = strtoupper($data->status_iuran);
                        $ret .= "<tr>
                                 <td>".$data->name."</td>
                                 <td>".$data->keterangan."</td>
                                 <td>".$stat."</td>
                                 <td><a href='".base_url()."/assets-admin/panel/images/bukti-premi/$data->path' target='_blank'>Gambar</a></td>
                                 </tr>";
                    }
                } else {
                    $ret .= "<tr><td style='text-align:center;' colspan='4'>Tidak ada yang ditemukan.</td></tr>";
                }
                $ret .= "</tbody>
                         <tfoot>
                         <tr>
                         <td colspan='4' class='text-center'>
                         <a href='".base_url()."/lapor/print_report' target='_blank' class='btn btn-outline-secondary tx-12 tx-uppercase tx-mont tx-medium'>
                         <span style='vertical-align:middle;'>Cetak Laporan</span>
                         </a>
                         </td>
                         </tr>
                         </tfoot>
                         </table>";
                return $ret;
        } else {
            exit('Request Error');
        }
    }
    
    // public function print_report()
    // {
    //     if (session()->get('username') == '') {
    //         session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
    //         return redirect()->to(base_url('/panel'));
    //     }
    //     // $tglAwal  = $this->input->get('var1');
    //     // $tglAkhir = $this->input->get('var2');
    //     // $res = $this->m_layanan->getLaporByTgl($tglAwal, $tglAkhir);
        
    //     // $nama = $res[0]->nama;

    //     $pdf = new FPDF();
    //     $pdf->AddPage('P', 'A4');
    //     $pdf->setFont('Arial', 'B', 8);
    //     $pdf->Cell(90, 1, 'LAPORAN', 0, 0, 'C');
    //     $pdf->Cell(10, 5, '', 0, 0, 'C');
    //     $pdf->Cell(90, 5, '', 0, 1, 'C');
    //     $pdf->setFont('Arial', 'BI', 14);
    //     $pdf->Cell(90, 0, 'RSUD PALEMBANG BARI', 0, 0, 'C');
    //     $pdf->Cell(10, 5, '', 0, 0, 'C');
    //     $pdf->SetLineWidth(1.2);
    //     $pdf->Line(6, 21, 104, 21);
    //     $pdf->Ln(9);

    //     $pdf->setX('30');
    //     $pdf->setFont('Arial', 'B', 7);
    //     $pdf->Cell(16, 4, 'Nama', 0, 0, 'L');
    //     $pdf->Cell(1, 4, ':', 0, 0, 'L');
    //     $pdf->setFont('Arial', '', 7);
    //     $pdf->Cell(53, 4, 'MAMAN', 0, 1, 'L');
    //     $pdf->Ln(2);

    //     $pdf->Output('report_pengaduan.pdf', 'I');
    //     exit();
    //     // $data = [
    //     //     'title'  => 'Report Pengaduan',
    //     //     'active' => 'reportlapor',
    //     // ];
    //     // return view('admin/lapor/index');
    // }
}
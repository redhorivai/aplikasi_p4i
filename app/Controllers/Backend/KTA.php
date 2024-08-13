<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Libraries\Date\DateFunction;
use App\Libraries\fpdf\FPDF;
use App\Models\Backend\KtaModel;
use Dompdf\Options;
use Dompdf\Dompdf;

class KTA extends BaseController
{
    protected $m_kta;
    protected $session;
    public function __construct()
    {
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
        $id_session = session()->get('user_id');
        $kta = $this->m_kta->getKta($id_session);
        $data = [
            'title'    => 'e-KTA Digital',
            'active'   => 'kta',
            'kta'      => $kta,
        ];
        return view('admin/kta/index', $data);
        // print_r(json_encode($data));
        // print_r($kta);
    }
    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            // print_r($id);
            $valid = $this->validate([
                'cabang'            => ['rules' => 'required'],
                'photo' => [
                    'label' => 'Logo',
                    'rules' => 'max_size[photo,3072]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'cabang'       => $this->validation->getError('cabang'),
                        'photo'        => $this->validation->getError('photo'),
                    ]
                ];
            } else {
                $fileImg = $this->request->getFile('photo');
                $logoLama = $this->request->getPost('logoLama');
                if ($fileImg->getError() == 4) {
                    $photo = $logoLama;
                } else {
                    $photo = $fileImg->getRandomName();
                    $fileImg->move('assets-front/images/logo', $photo);
                    if ($logoLama != 'no_image.png') {
                        unlink('assets-front/images/logo/' . $logoLama);
                    }
                }

                $data = [
                    'cabang'               => $this->request->getPost('cabang'),
                    'photo'                => $photo,
                    'updated_user'         => session()->get('user_id'),
                    'updated_dttm'         => date('Y-m-d H:i:s'),
                ];
                $this->m_kta->updateData($id, $data);
                $msg = [
                    'sukses' => 'Profil instansi berhasil diperbaharui'
                ];
            }
            // print_r($data);
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }
    public function digital_kta()
    {
        if ($this->request->isAJAX()) {
            $id      = $this->request->getPost('id');
            $user_id      = session()->get('user_id');
            $ekta = $this->m_kta->getIDKta($user_id);
            // print_r($ekta);

            $ret = "";
            $no = 1;
            foreach ($ekta as $key) {
                $ret .= "<div class='modal-dialog modal-lg' role='document'>
                         <div class='modal-content'>
                         <div class='modal-header' style='margin-bottom:30px;'>
                         <h5 class='text-center text-dark w-100'><b>".$key->cabang."</b><br><small class='w-100' style='font-size:12px;color:#888;'>Admin | ".$this->date->panjang($key->created_dttm)."</small></h5>
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
    // public function print_kta() MPDF
    // {
    //     $id_session = session()->get('user_id');
    //     $res_kta = $this->m_kta->getIDKta($id_session);
    //     // print_r(json_encode($res_kta));
    //     foreach ($res_kta as $key) {
    //         $mpdf = new Mpdf(['format' => [150, 75]]);
    //         $html_front = 'https://redhorivai.github.io/assets/img/ktacard_front.jpg';
    //         $row1 = '<div>
    //         <img src="https://redhorivai.github.io/assets/img/ktacard_front.jpg" alt="pic" />
    //         <p color:#000;>TEST</p>
    //         </div>';
    //         $html_back = 'https://redhorivai.github.io/assets/img/ktacard_back.jpg';
    //         $mpdf->WriteHTML($html_front);
    //         $mpdf->Image($html_front, 0, 0, 150, 75, 'png', '', true, false);
    //         $mpdf->AddPage();
    //         $mpdf->WriteHTML($html_back);
    //         $mpdf->Image($html_back, 0, 0, 150, 75, 'png', '', true, false);
    //         return redirect()->to($mpdf->Output('Digital_kta.pdf', 'I'));
    //         // print_r(json_encode($data));
    //     }

    //     // $mpdf = new Mpdf(['format' => [150, 75]]);
    //     // $html_front = 'https://redhorivai.github.io/assets/img/ktacard_front.jpg';
    //     // $html_back = 'https://redhorivai.github.io/assets/img/ktacard_back.jpg';
    //     // $mpdf->WriteHTML($html_front);
    //     // $mpdf->Image($html_front, 0, 0, 150, 75, 'png', '', true, false);
    //     // $mpdf->AddPage();
    //     // $mpdf->WriteHTML($html_back);
    //     // $mpdf->Image($html_back, 0, 0, 150, 75, 'png', '', true, false);
    //     // return redirect()->to($mpdf->Output('Digital_kta.pdf', 'I'));
    // }
    // public function print_kta()
    // {
    //     if (session()->get('username') == '') {
    //         session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
    //         return redirect()->to(base_url('/panel'));
    //     }
    //     $image = '<img src="https://redhorivai.github.io/assets/img/ktacard_front.jpg" alt="pic" />';
    //     // print_r($image);

    //     $pdf = new FPDF();
	// 	$pdf->Image('http://t1.gstatic.com/images?q=tbn:ANd9GcT9kiQoy9NiniQqbTSNXRQxeNtnOoXwuZuuYZiJzOV1gbfIZHippBfaZj2FxA#.jpg');
    //     $pdf->Output('KTA_Digital.pdf', 'I');
    //     // $pdf->Image('http://localhost:8080/assets-admin/panel/images/kta/kta.jpg', 60, 30, 90, 0, 'JPG');


    //     exit();
    //     // $data = [
    //     //     'title'  => 'Report Pengaduan',
    //     //     'active' => 'reportlapor',
    //     // ];
    //     // return view('admin/lapor/index');
    // }
}

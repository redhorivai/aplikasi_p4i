<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class Company extends BaseController
{
    protected $companymodel;
    protected $session;
    public function __construct()
    {
        $this->companymodel = new CompanyModel();
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
            'title'    => 'Company',
            'company'  => $this->companymodel->get_company()->getResult()

        ];
        return view('admin/company/company', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'company'  => $this->comp->get_company(),
            ];
            $msg = [
                'data' => view('admin/company/v_form', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $company_id = $this->request->getPost('company_id');

            $valid = $this->validate([
                'company_nm' => [
                    'label' => 'Company name',
                    'rules' => 'required[tbl_company.company_nm]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'company_phone' => [
                    'label' => 'Company phone',
                    'rules' => 'required[tbl_company.company_phone]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'company_email' => [
                    'label' => 'Company email',
                    'rules' => 'required[tbl_company.company_email]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'company_address' => [
                    'label' => 'Company address',
                    'rules' => 'required[tbl_company.company_address]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong!',
                    ]
                ],
                'company_logo' => [
                    'label' => 'Logo',
                    'rules' => 'max_size[company_logo,3072]|is_image[company_logo]|mime_in[company_logo,image/jpg,image/jpeg,image/png]',
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
                        'company_nm'      => $this->validation->getError('company_nm'),
                        'company_phone'   => $this->validation->getError('company_phone'),
                        'company_email'   => $this->validation->getError('company_email'),
                        'company_address' => $this->validation->getError('company_address'),
                        'company_logo'    => $this->validation->getError('company_logo'),
                    ]
                ];
            } else {
                $fileImg = $this->request->getFile('company_logo');
                $logoLama = $this->request->getPost('logoLama');
                if ($fileImg->getError() == 4) {
                    $company_logo = $logoLama;
                } else {
                    $company_logo = $fileImg->getRandomName();
                    $fileImg->move('img/company', $company_logo);
                    if ($logoLama != 'no_image.png') {
                        unlink('img/company/' . $logoLama);
                    }

                    $data = [
                        'company_nm'      => $this->request->getPost('company_nm'),
                        'company_phone'   => $this->request->getPost('company_phone'),
                        'company_email'   => $this->request->getPost('company_email'),
                        'company_address' => $this->request->getPost('company_address'),
                        'company_logo'    => $company_logo,
                    ];
                }
                $this->comp->update($company_id, $data);
                $msg = [
                    'sukses' => 'Data company berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Request Error');
        }
    }

    public function ambil_logo()
    {
        $company_id = 1;
        $coCek = $this->comp->companyCheck($company_id);
        $logo = $coCek['company_logo'];
        $msg = array(
            'logo' => $logo
        );
        // d($logo);
        return $this->response->setJSON($msg);
    }
    //--------------------------------------------------------------------

}

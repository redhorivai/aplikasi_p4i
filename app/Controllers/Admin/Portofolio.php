<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortofolioModel;
use App\Models\CategoryModel;

class portofolio extends BaseController
{
    protected $portofoliomodel;
    protected $categorymodel;
    protected $session;
    public function __construct()
    {
        $this->portofoliomodel = new PortofolioModel();
        $this->categorymodel = new CategoryModel();
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('Admin/'));
        }
        $ret = "";
        $portofolio = $this->portofoliomodel->get_portofolio()->getResult();

        if (count($portofolio) > 0) {
            foreach ($portofolio as $res) {
                $img = $this->portofoliomodel->getimageslim($res->portofolio_id)->getResult();
                $ret .= "<div class='card' style='width: 20rem; display: inline-block; margin: 10px;'>";
                foreach ($img as $key) {
                    $ret .= "<img onclick='showslide($res->portofolio_id);currentSlide(1)' class='card-img-top portofolioimg' src='../img/portofolio/$key->images_nm'>";
                }
                $ret .= "<div class='card-body'>
                        <h3>$res->portofolio_nm</h3>
                        <p class='card-text'>" . substr($res->category_nm, 0, 150) . "...</p>
                        <button onclick='edit($res->portofolio_id)' type='button' class='btn btn-primary'>Update</button>
                        <button onclick='hapus($res->portofolio_id,\"$res->portofolio_nm\")' type='button' class='btn btn-danger'>Delete</button>
                  </div>
                </div>";
            }
        } else {
            $ret = "";
        }

        $data = [
            'title'    => 'portofolio',
            'portofolio'  => $ret,
        ];
        return view('admin/portofolio/portofolio', $data);
    }


    public function formtambah()
    {
        $id = $this->request->uri->getSegment(4);
        $category = $this->categorymodel->get_category()->getResult();
        if ($id == "") {
            $data = [
                'title'    => 'portofolio',
                'category'  => $category,
            ];
            return view('admin/portofolio/formtambah', $data);
        } else {
            $portofolio = $this->portofoliomodel->getbyid($id)->getResult();
            $images = $this->portofoliomodel->getimages($id)->getResult();

            $data = [
                'title'    => 'portofolio',
                'category'  => $category,
                'portofolio' => $portofolio,
                'images' => $images
            ];
            return view('admin/portofolio/formedit', $data);
        }
    }
    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'portofolio_img' => [
                    'label' => 'portofolio Image',
                    'rules' => 'uploaded[portofolio_img]|max_size[portofolio_img,3072]|is_image[portofolio_img]|mime_in[portofolio_img,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih file gambar',
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = $this->validation->getError('portofolio_img');
            } else {

                $data = [
                    'portofolio_nm'     => $this->request->getPost('portofolio_nm'),
                    'category_id'    => $this->request->getPost('category_id'),
                    'description'    => $this->request->getPost('description'),
                    'created_user'   => session()->get('user_id'),
                    'created_dttm'   => date('Y-m-d H:i:s'),
                    'status_cd'      => 'normal',
                ];
                $portofolio_id = $this->portofoliomodel->insert($data);
                if ($portofolio_id != "") {
                    if ($imagefile = $this->request->getFiles()) {
                        foreach ($imagefile['portofolio_img'] as $img) {
                            if ($img->isValid() && !$img->hasMoved()) {
                                $portofolio_img = $img->getRandomName();
                                $img->move('img/portofolio', $portofolio_img);
                                $dataimg = [
                                    'fk_id' => $portofolio_id,
                                    'images_nm' => $portofolio_img,
                                    'images_path' => 'img/portofolio',
                                    'type' => 'portofolio',
                                    'status_cd' => 'normal',
                                    'created_dttm' => date('Y-m-d H:i:s'),
                                    'created_user' => $this->session->user_id
                                ];
                                $insertimage = $this->portofoliomodel->simpanimage($dataimg);
                            }
                        }
                    } else {
                        $portofolio_img = 'no_image.png';
                    }

                    $msg = "Sukses";
                } else {
                    $msg = "Error";
                }
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }


    public function updatedata() {
        $portofolio_id = $this->request->getPost('portofolio_id');
        if ($this->request->isAJAX()) {
            if ($imagefile = $this->request->getFiles()) {
                $valid = $this->validate([
                    'portofolio_img' => [
                        'label' => 'portofolio Image',
                        'rules' => 'max_size[portofolio_img,10072]|is_image[portofolio_img]|mime_in[portofolio_img,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Maksimal ukuran file 3 MB',
                            'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                            'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                        ]
                    ],
                ]);
            } else {
                $valid = true;
            }

            if (!$valid) {
                $msg = $this->validation->getError('portofolio_img');
            } else {

                $data = [
                    'portofolio_nm'     => $this->request->getPost('portofolio_nm'),
                    'category_id'    => $this->request->getPost('category_id'),
                    'description'    => $this->request->getPost('description'),
                    'updated_user' => session()->get('user_id'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $update = $this->portofoliomodel->update($portofolio_id, $data);
                if ($update) {
                    if ($imagefile = $this->request->getFiles()) {
                        foreach ($imagefile['portofolio_img'] as $img) {
                            if ($img->isValid() && !$img->hasMoved()) {
                                $portofolio_img = $img->getRandomName();
                                $img->move('img/portofolio', $portofolio_img);
                                $dataimg = [
                                    'fk_id' => $portofolio_id,
                                    'images_nm' => $portofolio_img,
                                    'images_path' => 'img/portofolio',
                                    'type' => 'portofolio',
                                    'status_cd' => 'normal',
                                    'created_dttm' => date('Y-m-d H:i:s'),
                                    'created_user' => $this->session->user_id
                                ];
                                $insertimage = $this->portofoliomodel->simpanimage($dataimg);
                            }
                        }
                    } else {
                        $portofolio_img = 'no_image.png';
                    }
                    $msg = 'Sukses';
                } else {
                    $msg = 'Error';
                }
            }
            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function hapusdata()
    {
        if ($this->request->isAJAX()) {
            $portofolio_id = $this->request->getPost('portofolio_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'     => 'nullified',
            ];
            $this->portofoliomodel->update($portofolio_id, $data);
            $msg = 'Sukses';

            return $msg;
        } else {
            exit('Request Error');
        }
    }

    public function showslide()
    {
        $id = $this->request->getPost('id');
        $img = $this->portofoliomodel->getimages($id)->getResult();

        $ret = "<span class='close cursor' onclick='closeModal()'>&times;</span>
                    <div class='modal-content-portofolio'>
                                <div class='col-md-12'>";
        foreach ($img as $key) {
            $ret .= "<div class='mySlides'>
                                              <div class='numbertext'>1 / 4</div>
                                              <img src='../img/portofolio/$key->images_nm' style='width:100%'>
                                            </div>";
        }

        $ret .= "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                                        <a class='next' onclick='plusSlides(1)'>&#10095;</a>";
        foreach ($img as $key) {
            $ret .= "<div class='column'>
                                                      <img class='demo cursor' src='../img/portofolio/$key->images_nm' style='width:100%' onclick='currentSlide(1)' alt='Nature and sunrise'>
                                                    </div>";
        }

        $ret .= "</div>
                    </div>";

        return $ret;
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $portofolio_id = $this->request->getPost('portofolio_id');
            $res = $this->portofoliomodel->getbyid($portofolio_id)->getResult();

            $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title'><i class='icon-film mr-1'></i> Detail portofolio</h4>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'><i class='icon-close' style='font-size:22px;color:#000;'></i></span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <h4 class='text-center'>";
            if (empty($res[0]->title)) {
                $ret .= 'No Title';
            } else {
                $ret .= '' . $res[0]->title . '';
            }

            $ret .= "</h4>
                                        <p class='text-center'>";
            if (empty($res[0]->sub_title)) {
                $ret .= '-';
            } else {
                $ret .= '' . $res[0]->sub_title . '';
            }

            $ret .= "</p>
                                        <img class='img-fluid' src='" . base_url() . "/img/portofolio/" . $res[0]->portofolio_img . "'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";

            return $ret;
        } else {
            exit('Request Error');
        }
    }
    //--------------------------------------------------------------------
    public function hapusimg()
    {
        $data = [
            'nullified_user' => session()->get('user_id'),
            'nullified_dttm' => date('Y-m-d H:i:s'),
            'status_cd'     => 'nullified',
        ];
        $remove = $this->portofoliomodel->removeimg($this->request->getPost('id'), $data);
        if ($remove) {
            $msg = "Sukses";
        } else {
            $msg = "Error";
        }

        return $msg;
    }
}

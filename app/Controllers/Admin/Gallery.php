<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GalleryModel;
use App\Models\CategoryModel;

class gallery extends BaseController
{
    protected $gallerymodel;
    protected $categorymodel;
    protected $session;
    public function __construct(){
        $this->gallerymodel = new GalleryModel();
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
        $gallery = $this->gallerymodel->get_gallery()->getResult();

        if (count($gallery)>0) {
            foreach ($gallery as $res) {
                $img = $this->gallerymodel->getimageslim($res->gallery_id)->getResult();
                $ret .= "<div class='card' style='width: 20rem; display: inline-block; margin: 10px;'>";
                foreach ($img as $key) {
                    $ret .= "<img onclick='showslide($res->gallery_id);currentSlide(1)' class='card-img-top galleryimg' src='../img/gallery/$key->images_nm'>";
                   
                }
                $ret .= "<div class='card-body'>
                        <h3>$res->gallery_nm</h3>
                        <p class='card-text'>".substr($res->category_nm, 0,150)."...</p>
                        <button onclick='edit($res->gallery_id)' type='button' class='btn btn-primary'>Update</button>
                        <button onclick='hapus($res->gallery_id,\"$res->gallery_nm\")' type='button' class='btn btn-danger'>Delete</button>
                  </div>
                </div>";
            }
        } else {
            $ret = "";
        }
        
        $data = [
            'title'    => 'gallery',
            'gallery'  => $ret,
        ];
        return view('admin/gallery/gallery', $data);
    }


public function formtambah() {
    $id = $this->request->uri->getSegment(4);
    $category = $this->categorymodel->get_category()->getResult();
    if ($id == "") {
        $data = [
            'title'    => 'gallery',
            'category'  => $category,
        ];
        return view('admin/gallery/formtambah', $data);
    } else {
        $gallery = $this->gallerymodel->getbyid($id)->getResult();
        $images = $this->gallerymodel->getimages($id)->getResult();
       
        $data = [
            'title'    => 'gallery',
            'category'  => $category,
            'gallery' => $gallery,
            'images' => $images
        ];
        return view('admin/gallery/formedit', $data);
        
    }
    
}
    public function simpandata() {
        if ($this->request->isAJAX()) {
            $valid = $this->validate([
                'gallery_img' => [
                    'label' => 'gallery Image',
                    'rules' => 'uploaded[gallery_img]|max_size[gallery_img,3072]|is_image[gallery_img]|mime_in[gallery_img,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Silahkan pilih file gambar',
                        'max_size' => 'Maksimal ukuran file 3 MB',
                        'is_image' => 'Hanya eksetensi .png | .jpg | .jpeg',
                        'mime_in'  => 'Hanya eksetensi .png | .jpg | .jpeg',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = $this->validation->getError('gallery_img');
            } else {

                $data = [
                    'gallery_nm'     => $this->request->getPost('gallery_nm'),
                    'category_id'    => $this->request->getPost('category_id'),
                    'description'    => $this->request->getPost('description'),
                    'created_user'   => session()->get('user_id'),
                    'created_dttm'   => date('Y-m-d H:i:s'),
                    'status_cd'      => 'normal',
                ];
                $gallery_id = $this->gallerymodel->insert($data);
                if ($gallery_id != "") {
                    if ($imagefile = $this->request->getFiles()) {
                        foreach($imagefile['gallery_img'] as $img){
                          if ($img->isValid() && ! $img->hasMoved()){
                            $gallery_img = $img->getRandomName();
                            $img->move('img/gallery', $gallery_img);
                            $dataimg = [
                                'fk_id' => $gallery_id,
                                'images_nm' => $gallery_img,
                                'images_path' => 'img/gallery',
                                'type' => 'gallery',
                                'status_cd' => 'normal',
                                'created_dttm' => date('Y-m-d H:i:s'),
                                'created_user' => $this->session->user_id
                            ];
                            $insertimage = $this->gallerymodel->simpanimage($dataimg);
                            }
                        }
                    } else {
                        $gallery_img = 'no_image.png';
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
        $gallery_id = $this->request->getPost('gallery_id');
        if ($this->request->isAJAX()) {
            if ($imagefile = $this->request->getFiles()) {
                $valid = $this->validate([
                    'gallery_img' => [
                        'label' => 'gallery Image',
                        'rules' => 'max_size[gallery_img,10072]|is_image[gallery_img]|mime_in[gallery_img,image/jpg,image/jpeg,image/png]',
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
                $msg = $this->validation->getError('gallery_img');
            } else {

                $data = [
                    'gallery_nm'     => $this->request->getPost('gallery_nm'),
                    'category_id'    => $this->request->getPost('category_id'),
                    'description'    => $this->request->getPost('description'),
                    'updated_user' => session()->get('user_id'),
                    'updated_dttm' => date('Y-m-d H:i:s'),
                ];
                $update = $this->gallerymodel->update($gallery_id, $data);
                if ($update) {
                    if ($imagefile = $this->request->getFiles()) {
                        foreach($imagefile['gallery_img'] as $img){
                          if ($img->isValid() && ! $img->hasMoved()){
                            $gallery_img = $img->getRandomName();
                            $img->move('img/gallery', $gallery_img);
                            $dataimg = [
                                'fk_id' => $gallery_id,
                                'images_nm' => $gallery_img,
                                'images_path' => 'img/gallery',
                                'type' => 'gallery',
                                'status_cd' => 'normal',
                                'created_dttm' => date('Y-m-d H:i:s'),
                                'created_user' => $this->session->user_id
                            ];
                            $insertimage = $this->gallerymodel->simpanimage($dataimg);
                            }
                        }
                    } else {
                        $gallery_img = 'no_image.png';
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
            $gallery_id = $this->request->getPost('gallery_id');
            $data = [
                'nullified_user' => session()->get('user_id'),
                'nullified_dttm' => date('Y-m-d H:i:s'),
                'status_cd'     => 'nullified',
            ];
            $update = $this->gallerymodel->update($gallery_id, $data);
            if ($update) {
                $msg = 'Sukses';
            } else {
                $msg = 'Error';
            }
            return $msg;
        } else {
            return "Request Error";
        }
    }

    public function showslide() {
        $id = $this->request->getPost('id');
        $img = $this->gallerymodel->getimages($id)->getResult();

        $ret = "<span class='close cursor' onclick='closeModal()'>&times;</span>
                    <div class='modal-content-gallery'>
                                <div class='col-md-12'>";
                                foreach ($img as $key) {
                                    $ret .= "<div class='mySlides'>
                                              <div class='numbertext'>1 / 4</div>
                                              <img src='../img/gallery/$key->images_nm' style='width:100%'>
                                            </div>";
                                }
                                    
                                $ret .= "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                                        <a class='next' onclick='plusSlides(1)'>&#10095;</a>";
                                        foreach ($img as $key) {
                                            $ret .= "<div class='column'>
                                                      <img class='demo cursor' src='../img/gallery/$key->images_nm' style='width:100%' onclick='currentSlide(1)' alt='Nature and sunrise'>
                                                    </div>";
                                            }

                        $ret .= "</div>
                    </div>";

        return $ret;
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $gallery_id = $this->request->getPost('gallery_id');
            $res = $this->gallerymodel->getbyid($gallery_id)->getResult();

            $ret = "<div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title'><i class='icon-film mr-1'></i> Detail gallery</h4>
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
                                        <img class='img-fluid' src='".base_url()."/img/gallery/".$res[0]->gallery_img."'>
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
    public function hapusimg(){
        $data = [
            'nullified_user' => session()->get('user_id'),
            'nullified_dttm' => date('Y-m-d H:i:s'),
            'status_cd'     => 'nullified',
        ];
        $remove = $this->gallerymodel->removeimg($this->request->getPost('id'), $data);
        if ($remove) {
            $msg = "Sukses";
        } else {
            $msg = "Error";
        }
        
        return $msg;
    }



}

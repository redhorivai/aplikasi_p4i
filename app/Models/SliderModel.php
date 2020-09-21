<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table         = 'slider';
    protected $primaryKey    = 'slider_id';
    protected $allowedFields = ['slider_id', 'title', 'sub_title', 'slider_img', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm', 'status_cd'];

    public function get_slider()
    {
        return $this->db->table('slider')
            ->where('status_cd', 'normal')
            ->orderBy('slider_id', 'DESC')
            ->get();
    }

    public function getbyid($id) {
        return $this->db->table($this->table)
                ->where('status_cd','normal')
                ->where('slider_id',$id)
                ->get();
    }
}

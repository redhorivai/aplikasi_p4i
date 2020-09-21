<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table         = 'vendor';
    protected $primaryKey    = 'vendor_id';
    protected $allowedFields = ['vendor_id', 'vendor_nm', 'category_id', 'description', 'image',  'status_cd', 'created_user', 'created_dttm', 'update_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_vendor()
    {
        return $this->db->table('vendor a')
            ->join('category b', 'b.category_id=a.category_id')
            ->orderBy('a.vendor_id', 'DESC')
            ->where('a.status_cd', 'normal')
            ->get();
    }

    public function getbyid($id)
    {
        return $this->db->table($this->table)
            ->where('status_cd', 'normal')
            ->where('vendor_id', $id)
            ->get();
    }

    public function deletecat($id)
    {
        return $this->db->table($this->table)
            ->where('vendor_id', $id)
            ->set('status_cd', 'nullified')
            ->update();
    }
}

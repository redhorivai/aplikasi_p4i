<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'product';
    protected $primaryKey    = 'product_id';
    protected $allowedFields = ['product_id', 'product_cd', 'product_nm', 'category_id', 'description', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm', 'status_cd', 'price1', 'price2'];


    public function get_product()
    {
        return $this->db->table('product a')
            ->join('category b', 'a.category_id=b.category_id')
            ->where('a.status_cd', 'normal')
            ->orderBy('a.product_id', 'DESC')
            ->get();
    }

    public function insertproduct($data)
    {
        $this->db->table($this->table)
            ->insert($data);
        return $this->db->insertID();
    }

    public function simpanimage($data)
    {
        return $this->db->table('images')
            ->insert($data);
    }

    public function getbyid($id)
    {
        return $this->db->table('product a')
            ->join('category b', 'a.category_id=b.category_id')
            ->where('a.status_cd', 'normal')
            ->where('a.product_id', $id)
            ->get();
    }

    public function getimages($id)
    {
        return $this->db->table('images')
            ->where('fk_id', $id)
            ->where('status_cd', 'normal')
            ->get();
    }

    public function removeimg($id, $data)
    {
        return $this->db->table('images')
            ->where('images_id', $id)
            ->update($data);
    }
}

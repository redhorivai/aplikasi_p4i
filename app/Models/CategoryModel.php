<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table         = 'category';
    protected $primaryKey    = 'category_id';
    protected $allowedFields = ['category_id', 'category_nm', 'type', 'status_cd', 'created_user', 'created_dttm', 'update_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

    public function get_category()
    {
        return $this->db->table('category')
            ->orderBy('category_id', 'DESC')
            ->where('status_cd', 'normal')
            ->get();
    }

    public function get_catArticle()
    {
        return $this->db->table('category')
            ->orderBy('category_id', 'ASC')
            ->where('type', 'artikel')
            ->where('status_cd', 'normal')
            ->get();
    }

    public function get_catPackage()
    {
        return $this->db->table('category')
            ->orderBy('category_id', 'ASC')
            ->where('type', 'product')
            ->where('status_cd', 'normal')
            ->get();
    }

    public function cek_category($category_nm, $type)
    {
        return $this->db->table('category')
            ->where(array('category_nm' => $category_nm, 'type' => $type))
            ->get()->getRowArray();
    }

    public function getbyid($id)
    {
        return $this->db->table($this->table)
            ->where('status_cd', 'normal')
            ->where('category_id', $id)
            ->get();
    }
}

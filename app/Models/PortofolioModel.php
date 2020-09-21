<?php

namespace App\Models;

use CodeIgniter\Model;

class portofolioModel extends Model
{
    protected $table         = 'portofolio';
    protected $primaryKey    = 'portofolio_id';
    protected $allowedFields = ['portofolio_id', 'portofolio_nm', 'category_id', 'description', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm', 'status_cd'];

    public function get_portofolio()
    {
        return $this->db->table('portofolio a')
            ->select('*')
            ->join('category b', 'b.category_id=a.category_id')
            ->where('a.status_cd', 'normal')
            ->orderBy('a.portofolio_id', 'DESC')
            ->get();
    }

    public function getbyid($id)
    {
        return $this->db->table('portofolio a')
            ->join('category b', 'b.category_id=a.category_id')
            ->where('a.status_cd', 'normal')
            ->where('a.portofolio_id', $id)
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

    public function getimageslim($id)
    {
        return $this->db->table('images')
            ->where('status_cd', 'normal')
            ->where('fk_id', $id)
            ->where('type', 'portofolio')
            ->limit(1)
            ->get();
    }

    public function getimages($id)
    {
        return $this->db->table('images')
            ->where('status_cd', 'normal')
            ->where('fk_id', $id)
            ->where('type', 'portofolio')
            ->get();
    }

    public function removeimg($id, $data)
    {
        return $this->db->table('images')
            ->where('images_id', $id)
            ->update($data);
    }
}

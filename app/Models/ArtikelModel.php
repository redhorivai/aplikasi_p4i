<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table         = 'artikel';
    protected $primaryKey    = 'artikel_id';
    protected $allowedFields = ['artikel_id', 'artikel_nm', 'category_id', 'artikel_img', 'description', 'status_cd', 'created_dttm', 'created_user', 'updated_dttm', 'updated_user', 'nullified_dttm', 'nullified_user	'];

    public function get_artikel()
    {
        return $this->db->table('artikel a')
            ->select('*,a.created_dttm as dttm_artikel')
            ->join('category b', 'b.category_id=a.category_id')
            ->orderBy('a.artikel_id', 'DESC')
            ->where('a.status_cd', 'normal')
            ->get();
    }

    public function getbyid($id)
    {
        return $this->db->table($this->table)
            ->where('artikel_id', $id)
            ->get();
    }
}

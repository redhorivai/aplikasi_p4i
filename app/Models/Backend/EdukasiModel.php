<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class EdukasiModel extends Model
{
    public function getEdukasi()
    {
        $query = $this->db->table('bcms_artikel');
        $query->select('*');
        $query->where('type', 'edukasi');
        $query->where('status_cd', 'normal');
        $query->orderBy('artikel_id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('bcms_artikel');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('artikel_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTitle($title)
    {
        $query = $this->db->table('bcms_artikel');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('title', $title);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekTitle($data['title']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('bcms_artikel');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('bcms_artikel');
        $query->where('artikel_id', $id);
        $query->set($data);
        return $query->update();
    }
    public function getLimit($limit)
    {
        $query = $this->db->table('bcms_artikel');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('type', 'edukasi');
        $query->orderBy('artikel_id', 'DESC');
        $query->limit($limit);
        $return = $query->get();
        return $return->getResult();
    }
}


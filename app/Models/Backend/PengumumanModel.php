<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    public function getPengumuman()
    {
        $query = $this->db->table('pengumuman');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTitle($judul)
    {
        $query = $this->db->table('pengumuman');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('judul', $judul);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekTitle($data['judul']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('pengumuman');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function getByID($id)
    {
        $query = $this->db->table('pengumuman');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('pengumuman');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('artikel_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function cekTitle($title)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('title', $title);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getLimit($limit)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->where('type', 'artikel');
    //     $query->orderBy('artikel_id', 'DESC');
    //     $query->limit($limit);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekTitle($data['title']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('bcms_artikel');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_artikel');
    //     $query->where('artikel_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}

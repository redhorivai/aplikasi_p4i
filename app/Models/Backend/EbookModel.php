<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class EbookModel extends Model
{
    public function getEbook()
    {
        $query = $this->db->table('p4i_ebook');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTitle($judul)
    {
        $query = $this->db->table('p4i_ebook');
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
            $query = $this->db->table('p4i_ebook');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function getByID($id)
    {
        $query = $this->db->table('p4i_ebook');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('p4i_ebook');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}

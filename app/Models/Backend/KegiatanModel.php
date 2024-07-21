<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    public function getKegiatan()
    {
        $query = $this->db->table('p4i_kegiatan');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->orderBy('id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('p4i_kegiatan');
        $query->select('*');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function cekTanggal($start_date)
    {
        $query = $this->db->table('p4i_kegiatan');
        $query->select('*');
        $query->where('start_date', $start_date);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->cekTanggal($data['start_date']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('p4i_kegiatan');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('p4i_kegiatan');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}

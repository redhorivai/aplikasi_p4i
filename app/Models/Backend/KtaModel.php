<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class KtaModel extends Model
{
    public function getKta($id)
    {
        $query = $this->db->table('p4i_anggota a');
        $query->select('a.id,a.no_anggota,a.cabang,a.tgl_belaku,a.photo,b.name,b.nik,b.tempat_lahir,b.gender,b.address,b.user_id');
        $query->join('bcms_users b', 'b.user_id = a.id_user','left');
        $query->where('a.status_cd', 'normal');
        $query->where('b.user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('p4i_anggota');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
    public function getIDKta($id)
    {
        $query = $this->db->table('p4i_anggota a');
        $query->select('a.id,a.no_anggota,a.cabang,a.tgl_belaku,a.photo,b.name,b.nik,b.tempat_lahir,b.gender,b.address,b.user_id,b.created_dttm');
        $query->join('bcms_users b', 'b.user_id = a.id_user','left');
        $query->where('a.status_cd', 'normal');
        $query->where('b.user_id', $id);
        $return = $query->get();
        return $return->getResult();
    }
    public function getByID($id)
    {
        $query = $this->db->table('p4i_anggota');
        $query->select('*');
        $query->where('status_cd', 'normal');
        $query->where('id', $id);
        $return = $query->get();
        return $return->getResult();
    }
}

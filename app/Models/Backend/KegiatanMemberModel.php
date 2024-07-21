<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class KegiatanMemberModel extends Model
{
    // public function getAgenda()
    // {
    //     $query = $this->db->table('p4i_join_kegiatan');
    //     $query->select('*');
    //     $query->where('status_cd', 'normal');
    //     $query->orderBy('id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function getAgenda()
    {
        $query = $this->db->table('p4i_join_kegiatan a');
        $query->select('a.status_join,a.created_dttm,b.name,c.nama,c.keterangan,c.start_date,c.end_date');
        $query->join('bcms_users b', 'b.user_id=a.id_user', 'left');
        $query->join('p4i_kegiatan c', 'c.id=a.id_kegiatan', 'left');
        $query->where('a.status_cd', 'normal');
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    
    // public function getByID($id)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->select('*');
    //     $query->where('user_id', $id);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function getIdKegiatan()
    // {
    //     $query = $this->db->table('p4i_join_kegiatan a');
    //     $query->select('a.id_kegiatan,b.id,b.nama,b.keterangan,b.start_date,b.end_date');
    //     $query->join('p4i_kegiatan b', 'b.id=a.id_kegiatan', 'left');
    //     $query->where('b.status_cd', 'normal');
    //     $query->orderBy('b.id', 'DESC');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function getIdKegiatan()
    {
        $query = $this->db->table('p4i_kegiatan');
        $query->select('*');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $query = $this->db->table('p4i_join_kegiatan');
        $ret =  $query->insert($data);
        return $ret;
    }
    // public function cekIdkegiatan($id_kegiatan)
    // {
    //     $query = $this->db->table('p4i_join_kegiatan');
    //     $query->select('*');
    //     $query->where('id_kegiatan', $id_kegiatan);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    // public function insertData($data)
    // {
    //     $cek = $this->cekIdkegiatan($data['id_kegiatan']);
    //     if(count($cek) > 0) {
    //         $ret =  false;
    //     } else {
    //         $query = $this->db->table('p4i_join_kegiatan');
    //         $ret =  $query->insert($data);
    //     }
    //     return $ret;
    // }
    // public function updateData($id, $data)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->where('user_id', $id);
    //     $query->set($data);
    //     return $query->update();
    // }
}

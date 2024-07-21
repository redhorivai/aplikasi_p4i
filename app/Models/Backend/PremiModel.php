<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class PremiModel extends Model
{
   
    public function getPremi($user_id)
    {
        $query = $this->db->table('p4i_premi a');
        $query->select('a.id,a.id_user,a.keterangan,a.path,a.status_iuran,a.status_cd,a.created_dttm,b.name,b.gender');
        $query->join('bcms_users b', 'b.user_id=a.id_user', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('b.user_id', $user_id);
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $query = $this->db->table('p4i_premi');
        $ret =  $query->insert($data);
        return $ret;
    }
    public function getDetail($user_id)
    {
        $query = $this->db->table('p4i_premi a');
        $query->select('a.id,a.id_user,a.keterangan,a.path,a.status_iuran,a.status_cd,a.created_dttm,b.name,b.gender,b.created_user');
        $query->join('bcms_users b', 'b.user_id=a.id_user', 'left');
        $query->where('a.status_cd', 'normal');
        $query->where('a.id_user', $user_id);
        $query->orderBy('a.id', 'DESC');
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('p4i_premi');
        $query->where('id', $id);
        $query->set($data);
        return $query->update();
    }
}

<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    // public function getProfil()
    // {
    //     $query = $this->db->table('person a');
    //     $query->select('a.id,a.nama,a.no_id,a.jenis_kelamin,a.tempat_lahir,a.tanggal_lahir,a.alamat,b.prodi_nm');
    //     $query->join('prodi b', 'b.id=a.prodi_id', 'left');
    //     $query->orderBy('a.id');
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function getProfil($user_id)
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('status_acc', 'active');
        $query->where('status_cd', 'normal');
        $query->orderBy('user_id', $user_id);
        $return = $query->get();
        return $return->getResult();
    }
    public function updateData($id, $data)
    {
        $query = $this->db->table('bcms_users');
        $query->where('user_id', $id);
        $query->set($data);
        return $query->update();
    }
}

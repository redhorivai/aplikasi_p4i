<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class DaftarModel extends Model
{
    // public function cekUsername($username)
    // {
    //     $query = $this->db->table('bcms_users');
    //     $query->select('*');
    //     $query->where('username', $username);
    //     $return = $query->get();
    //     return $return->getResult();
    // }
    public function NomorID($no_id)
    {
        $query = $this->db->table('bcms_users');
        $query->select('*');
        $query->where('no_id', $no_id);
        $return = $query->get();
        return $return->getResult();
    }
    public function insertData($data)
    {
        $cek = $this->NomorID($data['no_id']);
        if(count($cek) > 0) {
            $ret =  false;
        } else {
            $query = $this->db->table('bcms_users');
            $ret =  $query->insert($data);
        }
        return $ret;
    }
}

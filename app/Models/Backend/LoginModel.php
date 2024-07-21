<?php

namespace App\Models\Backend;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function login_check($username, $password){
        return $this->db->table('bcms_users')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
    }
    public function user_check($username)
    {
        return $this->db->table('bcms_users')
            ->where(array('username' => $username))
            ->get()->getRowArray();
    }
}

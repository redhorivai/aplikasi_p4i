<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function loginCheck($username, $password, $status_acc)
    {
        return $this->db->table('user')
            ->where(array('username' => $username, 'password' => $password, 'status_acc' => $status_acc))
            ->get()->getRowArray();
    }

    public function cekUser($username)
    {
        return $this->db->table('user')
            ->where(array('username' => $username))
            ->get()->getRowArray();
    }
}

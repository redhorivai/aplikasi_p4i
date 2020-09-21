<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'user';
    protected $primaryKey    = 'user_id';
    protected $allowedFields = ['user_id', 'name', 'username', 'gender', 'password', 'level', 'avatar', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm', 'status_acc', 'status_act'];

    public function get_user()
    {
        return $this->db->table('user')
            ->where('status_act', 'normal')
            ->orderBy('user_id', 'DESC')
            ->get();
    }

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

    public function getbyid($id)
    {
        return $this->db->table($this->table)
            ->where('status_act', 'normal')
            ->where('user_id', $id)
            ->get();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimoniModel extends Model
{
    protected $table         = 'testimoni';
    protected $primaryKey    = 'testimoni_id';
    protected $allowedFields = ['testimoni_id', 'nama', 'email', 'isi', 'status_cd', 'approved_dttm', 'approved_user', 'rejected_dttm', 'rejected_user', 'nullified_dttm', 'nullified_user   '];

    public function get_testimoni()
    {
        return $this->db->table('testimoni')
            ->orderBy('testimoni_id', 'DESC')
            ->whereIn('status_cd', ['normal', 'approved', 'rejected'])
            ->get();
    }

    public function getbynormal()
    {
        return $this->db->table('testimoni')
            ->orderBy('testimoni_id', 'DESC')
            ->whereIn('status_cd', ['normal', 'approved', 'rejected'])
            ->get();
    }

    public function getbyapproved()
    {
        return $this->db->table('testimoni')
            ->orderBy('testimoni_id', 'DESC')
            ->where('status_cd', 'approved')
            ->get();
    }

    public function getbyid($id)
    {
        return $this->db->table($this->table)
            ->where('status_cd', 'normal')
            ->where('testimoni_id', $id)
            ->get();
    }

    public function deletecat($id)
    {
        return $this->db->table($this->table)
            ->where('testimoni_id', $id)
            ->set('status_cd', 'nullified')
            ->update();
    }
}

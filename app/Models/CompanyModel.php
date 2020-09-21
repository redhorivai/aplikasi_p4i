<?php

namespace app\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table         = 'company';
    protected $primaryKey    = 'company_id';
    protected $allowedFields = ['company_id', 'company_nm', 'company_phone', 'company_email', 'company_address', 'company_logo'];

    public function get_company()
    {
        return $this->db->table('company')
            ->orderBy('company_id', 'DESC')
            ->limit(1)
            ->get();
    }
    public function companyCheck($company_id)
    {
        return $this->db->table('company')
            ->where(array('company_id' => $company_id))
            ->limit(1)
            ->get()->getRowArray();
    }
}

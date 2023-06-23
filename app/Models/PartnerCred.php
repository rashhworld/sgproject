<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerCred extends Model
{
    protected $table = 'partnercred';
    protected $primaryKey = 'pcId';
    protected $allowedFields = ['pName', 'pState', 'pEmail', 'vEmail', 'pMobile', 'vMobile', 'pPassword', 'pOrgType', 'pUniqueId'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerAppl extends Model
{
    protected $table = 'partnerappl';
    protected $primaryKey = 'apId ';
    protected $allowedFields = ['pcId', 'noId', 'apState', 'apDistrict', 'apStatus', 'apRemark'];
}

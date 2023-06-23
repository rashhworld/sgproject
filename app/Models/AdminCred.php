<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminCred extends Model
{
    protected $table = 'admincred';
    protected $primaryKey = 'aId';
    protected $allowedFields = ['aName', 'aEmail', 'aPass', 'aAccessType'];
}

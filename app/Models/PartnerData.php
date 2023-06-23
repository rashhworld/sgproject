<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerData extends Model
{
    protected $table = 'partnerdata';
    protected $primaryKey = 'pdId';
    protected $allowedFields = ['pcId', 'orgName', 'orgRegDate', 'orgNgoUnqId', 'orgNgoOprState', 'orgNgoOprDist', 'orgNgoRegType', 'orgNgoType', 'orgNgoActName', 'orgRegNo', 'orgGstNo', 'orgPanNo', 'orgTanNo', 'orgRegDoc', 'orgGstDoc', 'orgPanDoc', 'orgTanDoc', 'orgOtherDoc', 'orgPresident', 'orgSecretary', 'orgDirector', 'orgMobile', 'orgEmail', 'orgWebsite', 'orgRegAddr', 'orgCntcName', 'orgCntcAadhar', 'orgCntcMobile', 'orgCntcEmail', 'orgCntcPost', 'orgCntcAddr'];
}

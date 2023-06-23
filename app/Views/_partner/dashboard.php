<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.14.0/js/selectize.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.14.0/css/selectize.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.14.0/css/selectize.bootstrap5.min.css" /> -->
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>">SG PROJECTS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a style="font-size: 17px" class="nav-link fw-bold" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regData">Registration Details</a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 17px" class="nav-link fw-bold" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showProfile">Your Account</a>
                </li>
                <li class="nav-item">
                    <a style="font-size: 17px" class="nav-link fw-bold text-danger" href="<?= base_url('PartnerControl/logout') ?>">Logout</a>
                </li>
            </ul>
            <?php if ($profData['pUniqueId'] != '') { ?>
            <!--<button class="btn btn-primary d-flex" data-bs-toggle="modal" data-bs-target="#partnerApply">Apply Now</button>-->
            <?php } ?>
        </div>
    </div>
</nav>

<?php if ($profData['pUniqueId'] == '') { ?>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h4 class="text-center text-white">Thanks for Registration. Your Request is under approval. We will contact you soon.</h4>
    </div>
<?php } else { ?><div class="text-center my-4">
        <div class="badge bg-white text-dark p-2 fs-5">
            UNIQUE ID : <?= $profData['pUniqueId'] ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Sl No.</th>
                        <th>Notification No.</th>
                        <th>Applied State</th>
                        <th>Applied District</th>
                        <th>Remarks</th>
                        <th>Status</th>
                    </tr>
                    <?php $cnt = 1;
                    foreach ($ptnrAppl as $pa) { ?>
                        <tr>
                            <td><?= $cnt++ ?></td>
                            <td>Notif No. 235-108</td>
                            <td><?= $pa['apState'] ?></td>
                            <td><?= $pa['apDistrict'] ?></td>
                            <td>
                                <?php if ($pa['apStatus'] == 0) { ?>
                                    <span class="text-primary">Waiting for physical verification</span>
                                <?php } else if ($pa['apStatus'] == 1) { ?>
                                    <span class="text-primary">Waiting for Field verification</span>
                                <?php } else if ($pa['apStatus'] == 2) { ?>
                                    <span class="text-success">Verification successful</span>
                                <?php } else { ?>
                                    <span class="text-danger"><?= $pa['apRemark'] ?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($pa['apStatus'] == 0) { ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php } else if ($pa['apStatus'] == 1) { ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php } else if ($pa['apStatus'] == 2) { ?>
                                    <span class="badge bg-success">Success</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">Rejected</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php } ?>

<div class="modal fade" id="partnerApply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Application Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="" class="row g-3">
                            <div class="col-md-12">
                                <label for="applyNotif" class="form-label">Select the Notification No</label>
                                <select class="form-select" name="applyNotif" id="applyNotif">
                                    <!--<option value="" selected disabled hidden>Choose Here</option>-->
                                    <option value="1">Notif No. 235-108</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="applyState" class="form-label">Select the State applying for</label>
                                <select class="form-select" name="applyState" id="applyState" onchange="selectState(this)">
                                    <!--<option value="" selected disabled hidden>Choose Here</option>-->
                                    <option value="Bihar">Bihar</option>
                                    <!--<option value="Chhattisgarh">Chhattisgarh</option>-->
                                    <!--<option value="Jharkhand">Jharkhand</option>-->
                                    <!--<option value="Madhya Pradesh">Madhya Pradesh</option>-->
                                    <!--<option value="Uttar Pradesh">Uttar Pradesh</option>-->
                                    <!--<option value="West Bengal">West Bengal</option>-->
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="applyDist" class="form-label">Select the District applying for <span style="font-size: 14px; color: blue">(Max 2 District)</span></label>
                                <div class="dist_Bihar">
                                    <div class="form-check">
                                        <label class="form-check-label" for="Nawada">
                                            Nawada
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="Nawada" name="applyDist[]" id="Nawada" onchange="selectDistrict()">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Bhojpur" name="applyDist[]" id="Bhojpur" onchange="selectDistrict()">
                                        <label class="form-check-label" for="Bhojpur">
                                            Bhojpur
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Patna" name="applyDist[]" id="Patna" onchange="selectDistrict()">
                                        <label class="form-check-label" for="Patna">
                                            Patna
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Nalanda" name="applyDist[]" id="Nalanda" onchange="selectDistrict()">
                                        <label class="form-check-label" for="Nalanda">
                                            Nalanda
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Jehanabad" name="applyDist[]" id="Jehanabad" onchange="selectDistrict()">
                                        <label class="form-check-label" for="Jehanabad">
                                            Jehanabad
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Aurangabad" name="applyDist[]" id="Aurangabad" onchange="selectDistrict()">
                                        <label class="form-check-label" for="Aurangabad">
                                            Aurangabad
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Gaya" name="applyDist[]" id="defaultCheck1" onchange="selectDistrict()">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Gaya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit" onclick="partnerApply()">Apply Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Partner Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="row g-3">
                    <div class="col-md-12">
                        <label for="pName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="pName" id="pName" value="<?= $profData['pName'] ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="pEmail" class="form-label">Your Email ID</label>
                        <input type="text" class="form-control" name="pEmail" id="pEmail" value="<?= $profData['pEmail'] ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="pMobile" class="form-label">Your Mobile ID</label>
                        <input type="text" class="form-control" name="pMobile" id="pMobile" value="<?= $profData['pMobile'] ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="pregDate" class="form-label">Your joining Date</label>
                        <input type="text" class="form-control" name="pregDate" id="pregDate" value="<?= date("d/m/Y, g:i a", strtotime($profData['pRegDate'])) ?>" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understood</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="regData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registration Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tr>
                        <th class="text-info">Registration Details</th>
                        <th class="text-info">Document List</th>
                    </tr>
                    <?php if ($orgType == 1) { ?>
                        <tr>
                            <th>Organization Name</th>
                            <td><?= $ptnrDetails['orgName'] ?></td>
                        </tr>
                        <tr>
                            <th>Unique ID of NGO</th>
                            <td><?= $ptnrDetails['orgNgoUnqId'] ? $ptnrDetails['orgNgoUnqId'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Date</th>
                            <td><?= $ptnrDetails['orgRegDate'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration With</th>
                            <td>
                                <?php if ($ptnrDetails['orgRegType'] == 1) {
                                    print "Sub Registrar";
                                } else if ($ptnrDetails['orgRegType'] == 2) {
                                    print "Registrar of societies";
                                } else if ($ptnrDetails['orgRegType'] == 3) {
                                    print "Registrar of Companies";
                                } else {
                                    print "Any Other";
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Type of NGO</th>
                            <td>
                                <?php if ($ptnrDetails['orgNgoType'] == 1) {
                                    print "Trust (Non-Govt.)";
                                } else if ($ptnrDetails['orgNgoType'] == 2) {
                                    print "Registered Societies (Non-Govt.)";
                                } else if ($ptnrDetails['orgNgoType'] == 3) {
                                    print "Private Sector Companies (Sec 8/25)";
                                } else {
                                    print "Any Other";
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Act Name</th>
                            <td>
                                <?php if ($ptnrDetails['orgActName'] == 1) {
                                    print "India Trust Act";
                                } else if ($ptnrDetails['orgActName'] == 2) {
                                    print "Society Act";
                                } else if ($ptnrDetails['orgActName'] == 3) {
                                    print "Companies Act, 2013";
                                } else {
                                    print "Any Other";
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Operating State</th>
                            <td><?= $ptnrDetails['orgOprState'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Operating District</th>
                            <td><?= $ptnrDetails['orgOprDist'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Number</th>
                            <td><?= $ptnrDetails['orgRegNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgRegDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization FCRA Number</th>
                            <td><?= $ptnrDetails['orgFcraNo'] ? $ptnrDetails['orgFcraNo'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization FCRA Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgFcraDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgFcraDoc') . "/" . $ptnrDetails['orgFcraDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgFcraDoc') . "/" . $ptnrDetails['orgFcraDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization GST Number</th>
                            <td><?= $ptnrDetails['orgGstNo'] ? $ptnrDetails['orgGstNo'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization GST Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgGstDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization PAN Number</th>
                            <td><?= $ptnrDetails['orgPanNo'] ? $ptnrDetails['orgPanNo'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization PAN Document</th>
                            <td>
                                <?php if ($ptnrDetails['orgPanDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Other Document</th>
                            <td>
                                <?php if ($ptnrDetails['orgOtherDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgOtherDoc') . "/" . $ptnrDetails['orgOtherDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgOtherDoc') . "/" . $ptnrDetails['orgOtherDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization President Name</th>
                            <td><?= $ptnrDetails['orgPresName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Secretary Name</th>
                            <td><?= $ptnrDetails['orgSecrName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization City of Registration</th>
                            <td><?= $ptnrDetails['orgCityReg'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Mobile Number</th>
                            <td><?= $ptnrDetails['orgMobNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Email ID</th>
                            <td><?= $ptnrDetails['orgEmailId'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Webiste</th>
                            <td><?= $ptnrDetails['orgWebsite'] ? $ptnrDetails['orgWebsite'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registered Office Address</th>
                            <td><?= $ptnrDetails['orgRegAddr'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Name</th>
                            <td><?= $ptnrDetails['orgCntcName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Aadhar Number</th>
                            <td><?= $ptnrDetails['orgCntcAadhar'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Mobile Number</th>
                            <td><?= $ptnrDetails['orgCntcMob'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Email ID</th>
                            <td><?= $ptnrDetails['orgCntcEmail'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Post in Organization</th>
                            <td><?= $ptnrDetails['orgCntcPost'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Full Address</th>
                            <td><?= $ptnrDetails['orgCntcAddr'] ?></td>
                        </tr>
                    <?php } else if ($orgType == 2 || $orgType == 3) { ?>
                        <tr>
                            <th>Organization Name</th>
                            <td><?= $ptnrDetails['orgName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Date</th>
                            <td><?= $ptnrDetails['orgRegDate'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Number</th>
                            <td><?= $ptnrDetails['orgRegNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgRegDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Directors</th>
                            <td><?= $ptnrDetails['orgDrctr1'] . ", " . $ptnrDetails['orgDrctr2'] . ", " . $ptnrDetails['orgDrctr3'] . ", " . $ptnrDetails['orgDrctr4'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization GST Number</th>
                            <td><?= $ptnrDetails['orgGstNo'] ? $ptnrDetails['orgGstNo'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization GST Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgGstDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization PAN Number</th>
                            <td><?= $ptnrDetails['orgPanNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization PAN Document</th>
                            <td>
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization TAN Number</th>
                            <td><?= $ptnrDetails['orgTanNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization TAN Document</th>
                            <td>
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgTanDoc') . "/" . $ptnrDetails['orgTanDoc'] ?>" target="_blank">View Certificate</a> /
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgTanDoc') . "/" . $ptnrDetails['orgTanDoc'] ?>" download="">Download Certificate</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Mobile Number</th>
                            <td><?= $ptnrDetails['orgMobNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Email ID</th>
                            <td><?= $ptnrDetails['orgEmailId'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Webiste</th>
                            <td><?= $ptnrDetails['orgWebsite'] ? $ptnrDetails['orgWebsite'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registered Office Address</th>
                            <td><?= $ptnrDetails['orgRegAddr'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Name</th>
                            <td><?= $ptnrDetails['orgCntcName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Aadhar Number</th>
                            <td><?= $ptnrDetails['orgCntcAadhar'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Mobile Number</th>
                            <td><?= $ptnrDetails['orgCntcMob'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Email ID</th>
                            <td><?= $ptnrDetails['orgCntcEmail'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Post in Organization</th>
                            <td><?= $ptnrDetails['orgCntcPost'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Full Address</th>
                            <td><?= $ptnrDetails['orgCntcAddr'] ?></td>
                        </tr>
                    <?php } else if ($orgType == 4) { ?>
                        <tr>
                            <th>Organization Name</th>
                            <td><?= $ptnrDetails['orgName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Date</th>
                            <td><?= $ptnrDetails['orgRegDate'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Number</th>
                            <td><?= $ptnrDetails['orgRegNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registration Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgRegDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization GST Number</th>
                            <td><?= $ptnrDetails['orgGstNo'] ? $ptnrDetails['orgGstNo'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization GST Certificate</th>
                            <td>
                                <?php if ($ptnrDetails['orgGstDoc'] != '') { ?>
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                                    <a class="text-decoration-none" href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
                                <?php } else print "NA"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization PAN Number</th>
                            <td><?= $ptnrDetails['orgPanNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization PAN Document</th>
                            <td>
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                                <a class="text-decoration-none" href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Organization Mobile Number</th>
                            <td><?= $ptnrDetails['orgMobNo'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Email ID</th>
                            <td><?= $ptnrDetails['orgEmailId'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Webiste</th>
                            <td><?= $ptnrDetails['orgWebsite'] ? $ptnrDetails['orgWebsite'] : "NA" ?></td>
                        </tr>
                        <tr>
                            <th>Organization Registered Office Address</th>
                            <td><?= $ptnrDetails['orgRegAddr'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Name</th>
                            <td><?= $ptnrDetails['orgCntcName'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Aadhar Number</th>
                            <td><?= $ptnrDetails['orgCntcAadhar'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Mobile Number</th>
                            <td><?= $ptnrDetails['orgCntcMob'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Email ID</th>
                            <td><?= $ptnrDetails['orgCntcEmail'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Post in Organization</th>
                            <td><?= $ptnrDetails['orgCntcPost'] ?></td>
                        </tr>
                        <tr>
                            <th>Organization Contact Person Full Address</th>
                            <td><?= $ptnrDetails['orgCntcAddr'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understood</button>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    $("select").selectize({
        maxItems: 2,
    });
</script> -->
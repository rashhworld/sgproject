<!DOCTYPE html>
<html>

<head>
    <style>
        a {
            text-decoration: none;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 18px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">SG PROJECTS</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a style="font-size: 17px" class="nav-link fw-bold" href="<?= base_url('admin') ?>"><i class="fa-solid fa-arrow-left"></i> Back to Homepage</a>
                    </li>
                </ul>
                <a style="font-size: 17px" class="nav-link fw-bold text-danger" href="<?= base_url('AdminControl/logout') ?>">Admin, Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <?php if ($orgType == 1) { ?>
            <h3 class="my-5 text-center text-white">Organization : <?= $ptnrDetails['orgName'] ?></h3>
            <table class="mb-5" style="table-layout: fixed;">
                <tr>
                    <th class="text-info">Registration Details</th>
                    <th class="text-info">Document List</th>
                </tr>
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
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
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
                            <a href="<?= base_url('uploads/orgFcraDoc') . "/" . $ptnrDetails['orgFcraDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgFcraDoc') . "/" . $ptnrDetails['orgFcraDoc'] ?>" download="">Download Certificate</a>
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
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
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
                            <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
                        <?php } else print "NA"; ?>
                    </td>
                </tr>
                <tr>
                    <th>Organization Other Document</th>
                    <td>
                        <?php if ($ptnrDetails['orgOtherDoc'] != '') { ?>
                            <a href="<?= base_url('uploads/orgOtherDoc') . "/" . $ptnrDetails['orgOtherDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgOtherDoc') . "/" . $ptnrDetails['orgOtherDoc'] ?>" download="">Download Certificate</a>
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
            </table>
        <?php } else if ($orgType == 2 || $orgType == 3) { ?>
            <h3 class="my-5 text-center text-white">Company : <?= $ptnrDetails['orgName'] ?></h3>
            <table class="mb-5" style="table-layout: fixed;">
                <tr>
                    <th>Registration Details</th>
                    <th>Document List</th>
                </tr>
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
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
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
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
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
                        <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                        <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
                    </td>
                </tr>
                <tr>
                    <th>Organization TAN Number</th>
                    <td><?= $ptnrDetails['orgTanNo'] ?></td>
                </tr>
                <tr>
                    <th>Organization TAN Document</th>
                    <td>
                        <a href="<?= base_url('uploads/orgTanDoc') . "/" . $ptnrDetails['orgTanDoc'] ?>" target="_blank">View Certificate</a> /
                        <a href="<?= base_url('uploads/orgTanDoc') . "/" . $ptnrDetails['orgTanDoc'] ?>" download="">Download Certificate</a>
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
            </table>
        <?php } else if ($orgType == 4) { ?><h3 class="my-5 text-center text-white">Organization : <?= $ptnrDetails['orgName'] ?></h3>
            <table class="mb-5" style="table-layout: fixed;">
                <tr>
                    <th>Registration Details</th>
                    <th>Document List</th>
                </tr>
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
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgRegDoc') . "/" . $ptnrDetails['orgRegDoc'] ?>" download="">Download Certificate</a>
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
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" target="_blank">View Certificate</a> /
                            <a href="<?= base_url('uploads/orgGstDoc') . "/" . $ptnrDetails['orgGstDoc'] ?>" download="">Download Certificate</a>
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
                        <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" target="_blank">View Certificate</a> /
                        <a href="<?= base_url('uploads/orgPanDoc') . "/" . $ptnrDetails['orgPanDoc'] ?>" download="">Download Certificate</a>
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
            </table>
        <?php } ?>
    </div>
</body>

</html>
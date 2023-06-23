<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-sm-row flex-column">
                <h4><a href="/">SG PROJECT</a></h4>
                <h4 class="text-center">PARTNER REGISTRATION FORM</h4>
                <h5><a class="text-danger" href="<?= base_url('PartnerControl/logout') ?>">Logout</a></h5>
            </div>
        </div>
    </div>
    <div class="card my-3">
        <div class="card-body">
            <form class="row g-3 partnerPostData" autocomplete="off">
                <div class="col-md-12 bg-info text-white py-2">
                    <h5>Organization Details</h5>
                </div>
                <div class="col-md-4">
                    <label for="orgName" class="form-label">Enter Organization Name <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgName" id="orgName">
                </div>
                <div class="col-md-4">
                    <label for="orgRegDate" class="form-label">Enter Organization Registration Date <em class="text-danger">*</em></label>
                    <input type="date" class="form-control" name="orgRegDate" id="orgRegDate">
                </div>

                <?php if (session()->get('pOrgType') == 1) { ?>
                    <div class="col-md-4">
                        <label for="orgNgoUnqId" class="form-label">Enter Unique ID of NGO</label>
                        <input type="text" class="form-control" name="orgNgoUnqId" id="orgNgoUnqId">
                    </div>
                    <div class="col-md-4">
                        <label for="orgRegType" class="form-label">Select Registration With <em class="text-danger">*</em></label>
                        <select class="form-select" name="orgRegType" id="orgRegType">
                            <option value="" selected disabled hidden>Choose Here</option>
                            <option value="1">Sub Registrar</option>
                            <option value="2">Registrar of societies</option>
                            <option value="3">Registrar of Companies</option>
                            <option value="4">Any Others</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="orgNgoType" class="form-label">Select Type of NGO <em class="text-danger">*</em></label>
                        <select class="form-select" name="orgNgoType" id="orgNgoType">
                            <option value="" selected disabled hidden>Choose Here</option>
                            <option value="1">Trust (Non-Govt.)</option>
                            <option value="2">Registered Societies (Non-Govt.)</option>
                            <option value="3">Private Sector Companies (Sec 8/25)</option>
                            <option value="4">Any Others</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="orgActName" class="form-label">Select Organization Act Name <em class="text-danger">*</em></label>
                        <select class="form-select" name="orgActName" id="orgActName">
                            <option value="" selected disabled hidden>Choose Here</option>
                            <option value="1">India Trust Act</option>
                            <option value="2">Society Act</option>
                            <option value="3">Companies Act, 2013</option>
                            <option value="4">Any Others</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="orgOprState" class="form-label">Enter Organization Operating State <em class="text-danger">*</em></label>
                        <select class="form-select" name="orgOprState" id="orgOprState">
                            <option value="" selected disabled hidden>Choose Here</option>
                            <option value="Andhara Pradesh">Andhara Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telengana">Telengana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Utarakhand">Utarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="orgOprDist" class="form-label">Enter Organization Operating District <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgOprDist" id="orgOprDist">
                    </div>
                <?php } ?>

                <div class="col-md-4">
                    <label for="orgRegNo" class="form-label">Enter Organization Registration Number <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgRegNo" id="orgRegNo">
                </div>
                <div class="col-md-4">
                    <label for="orgGstNo" class="form-label">Enter Organization GST Number</label>
                    <input type="text" class="form-control" name="orgGstNo" id="orgGstNo">
                </div>
                <div class="col-md-4">
                    <label for="orgPanNo" class="form-label">Enter Organization PAN card Number</label>
                    <input type="text" class="form-control" name="orgPanNo" id="orgPanNo">
                </div>
                <div class="col-md-4">
                    <label for="orgTanNo" class="form-label">Enter Organization TAN card Number</label>
                    <input type="text" class="form-control" name="orgTanNo" id="orgTanNo">
                </div>

                <?php if (session()->get('pOrgType') == 1) { ?>
                    <div class="col-md-4">
                        <label for="orgPresName" class="form-label">Enter Organization President Name <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgPresName" id="orgPresName">
                    </div>
                    <div class="col-md-4">
                        <label for="orgSecrName" class="form-label">Enter Organization Secretary Name <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgSecrName" id="orgSecrName">
                    </div>
                <?php } else if (session()->get('pOrgType') == 2) { ?>
                    <div class="col-md-4">
                        <label for="orgDrctr1" class="form-label">Enter Director's Name(1) <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgDrctr1" id="orgDrctr1">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr2" class="form-label">Enter Director's Name(2) <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgDrctr2" id="orgDrctr2">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr3" class="form-label">Enter Director's Name(3)</label>
                        <input type="text" class="form-control" name="orgDrctr3" id="orgDrctr3">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr4" class="form-label">Enter Director's Name(4)</label>
                        <input type="text" class="form-control" name="orgDrctr4" id="orgDrctr4">
                    </div>
                <?php } else if (session()->get('pOrgType') == 3) { ?>
                    <div class="col-md-4">
                        <label for="orgDrctr1" class="form-label">Enter Partner's Name(1) <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgDrctr1" id="orgDrctr1">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr2" class="form-label">Enter Partner's Name(2) <em class="text-danger">*</em></label>
                        <input type="text" class="form-control" name="orgDrctr2" id="orgDrctr2">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr3" class="form-label">Enter Partner's Name(3)</label>
                        <input type="text" class="form-control" name="orgDrctr3" id="orgDrctr3">
                    </div>
                    <div class="col-md-4">
                        <label for="orgDrctr4" class="form-label">Enter Partner's Name(4)</label>
                        <input type="text" class="form-control" name="orgDrctr4" id="orgDrctr4">
                    </div>
                <?php } ?>

                <div class="col-md-4">
                    <label for="orgMobNo" class="form-label">Enter Organization Mobile Number <em class="text-danger">*</em></label>
                    <!-- <b class="text-primary border border-primary rounded px-2 float-end f-bold" role="button" onclick="send_otp('Mobile', '#orgMobNo')">Get OTP</b> -->
                    <input type="tel" class="form-control" name="orgMobNo" id="orgMobNo">
                </div>
                <div class="col-md-4">
                    <label for="orgEmailId" class="form-label">Enter Organization Email Id <em class="text-danger">*</em></label>
                    <em class="text-primary float-end" role="button" onclick="send_otp('Email', '#orgEmailId', '../PartnerControl/send_otp')">Verify Email</em>
                    <input type="email" class="form-control" name="orgEmailId" id="orgEmailId">
                </div>
                <div class="col-md-4">
                    <label for="orgWebsite" class="form-label">Enter Organization Website</label>
                    <input type="text" class="form-control" name="orgWebsite" id="orgWebsite">
                </div>
                <div class="col-md-4">
                    <label for="orgRegAddr" class="form-label">Enter Organization Registered Office Full Address <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgRegAddr" id="orgRegAddr">
                </div>
                <div class="col-md-12 bg-info text-white py-2">
                    <h5>Documents and Certificates File</h5>
                </div>
                <div class="col-md-4">
                    <label for="orgRegDoc" class="form-label">Upload Organization Registration Certificate <em class="text-danger">*</em></label>
                    <input type="file" class="form-control" name="orgRegDoc" id="orgRegDoc">
                </div>
                <div class="col-md-4">
                    <label for="orgGstDoc" class="form-label">Upload Organization GST Certificate</label>
                    <input type="file" class="form-control" name="orgGstDoc" id="orgGstDoc">
                </div>
                <div class="col-md-4">
                    <label for="orgPanDoc" class="form-label">Upload Organization PAN Document</label>
                    <input type="file" class="form-control" name="orgPanDoc" id="orgPanDoc">
                </div>
                <div class="col-md-4">
                    <label for="orgTanDoc" class="form-label">Upload Organization TAN Document</label>
                    <input type="file" class="form-control" name="orgTanDoc" id="orgTanDoc">
                </div>
                <div class="col-md-4">
                    <label for="orgOtherDoc" class="form-label">Upload Organization Other Document (any award, etc)</label>
                    <input type="file" class="form-control" name="orgOtherDoc" id="orgOtherDoc">
                </div>
                <div class="col-md-12 bg-info text-white py-2">
                    <h5>Organization Contact Person Details</h5>
                </div>
                <div class="col-md-4">
                    <label for="orgCntcName" class="form-label">Contact Person Name <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgCntcName" id="orgCntcName">
                </div>
                <div class="col-md-4">
                    <label for="orgCntcAadhar" class="form-label">Contact Person Aadhar Number (Last 4 Digit) <em class="text-danger">*</em></label>
                    <input type="number" class="form-control" name="orgCntcAadhar" id="orgCntcAadhar">
                </div>
                <div class="col-md-4">
                    <label for="orgCntcMob" class="form-label">Contact Person Mobile Number <em class="text-danger">*</em></label>
                    <input type="tel" class="form-control" name="orgCntcMob" id="orgCntcMob">
                </div>
                <div class="col-md-4">
                    <label for="orgCntcEmail" class="form-label">Contact Person Email Id <em class="text-danger">*</em></label>
                    <input type="email" class="form-control" name="orgCntcEmail" id="orgCntcEmail">
                </div>
                <div class="col-md-4">
                    <label for="orgCntcPost" class="form-label">Contact Person Post in Organization <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgCntcPost" id="orgCntcPost">
                </div>
                <div class="col-md-4">
                    <label for="orgCntcAddr" class="form-label">Contact Person Full Address <em class="text-danger">*</em></label>
                    <input type="text" class="form-control" name="orgCntcAddr" id="orgCntcAddr">
                </div>
                <div class="col-md-12 text-center mt-5">
                    <button type="submit" class="btn btn-primary" onclick="validatePartnerPostRegister()">Validate and Submit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="OTPData" class="form-label"></label>
                    <input type="email" class="form-control" name="OTPData" id="OTPData">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="verifyModalBtn">Click to Verify</button>
            </div>
        </div>
    </div>
</div>
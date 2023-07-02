<?php

namespace App\Controllers;

class PartnerControl extends BaseController
{
    public function testing()
    {
        return view('_partner/testing');
    }

    public function index()
    {
        return view('_partner/index');
    }

    public function validatePartnerLogin()
    {
        if ($this->validate([
            "pCred" => ["label" => "Email or Phone", "rules" => "trim|required|"],
            "pPass" => ["label" => "Password", "rules" => "trim|required|min_length[6]"],
        ])) {
            $pCred = $this->request->getVar('pCred');
            $pPass = $this->request->getVar('pPass');
            strpos($pCred, '@') ? $ptnrData = $this->pc->where('pEmail', $pCred)->first() : $ptnrData = $this->pc->where('pMobile', $pCred)->first();

            if ($ptnrData) {
                if (password_verify($pPass, $ptnrData['pPassword'])) {
                    $ses_data = ['pcId' => $ptnrData['pcId'], 'pName' => $ptnrData['pName'], 'pOrgType' => $ptnrData['pOrgType'], 'partnerLogged_in' => TRUE];
                    $this->session->set($ses_data);

                    if ($this->pd->where('pcId', $ptnrData['pcId'])->first()) {
                        $response = ['type' => 1, 'url' => base_url('partner/dashboard')];
                    } else {
                        $response = ['type' => 1, 'url' => base_url('partner/postregister')];
                        $this->session->set('pOrgType', $ptnrData['pOrgType']);
                    }
                    $this->session->remove('sEmail', 'vEmail', 'sMobile', 'vMobile', 'pOrgType');
                } else {
                    $response = ['type' => 0, 'msg' => 'Wrong Password Entered.',];
                }
            } else {
                $response = ['type' => 0, 'msg' => 'No Partner Exist with this Credentials.',];
            }
        } else {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
            return $this->response->setJSON($response);
        }
        return $this->response->setJSON($response);
    }

    public function validatePartnerPreRegister()
    {
        if ($this->validate([
            "pName" =>      ["label" => "Name", "rules" => "trim|required|"],
            "pState" =>      ["label" => "State", "rules" => "trim|required|"],
            "pEmail" =>     ["label" => "Email", "rules" => "trim|required|valid_email"],
            "pMobile" =>    ["label" => "Mobile", "rules" => "trim|required|is_natural|exact_length[10]"],
            "pPass" =>      ["label" => "Password", "rules" => "trim|required|min_length[6]"],
            "pOrgType" =>   ["label" => "Organization Type", "rules" => "trim|required|"],
        ])) {
            $pName =        $this->request->getVar('pName');
            $pState =       $this->request->getVar('pState');
            $pEmail =       $this->request->getVar('pEmail');
            $pMobile =      $this->request->getVar('pMobile');
            $pOrgType =     $this->request->getVar('pOrgType');
            $pPass =        $this->request->getVar('pPass');

            if ($this->pc->where('pEmail', $pEmail)->first()) {
                $response = ['type' => 0, 'msg' => 'Partner with this Email already Exist.',];
            } else {
                if ($this->pc->where('pMobile', $pMobile)->first()) {
                    $response = ['type' => 0, 'msg' => 'Partner with this Mobile already Exist.',];
                } else {
                    // if ($this->session->get('sEmail') && $this->session->get('sMobile')) {
                    if ($this->session->get('vEmail')) {
                        $data = [
                            'pName' => $pName,
                            'pState' => $pState,
                            'pEmail' => $pEmail,
                            'pMobile' => $pMobile,
                            'pPassword' => password_hash($pPass, PASSWORD_DEFAULT),
                            'pOrgType' => $pOrgType,
                        ];
                        $this->pc->save($data);
                        $this->session->remove(['sEmail', 'sMobile', 'vEmail', 'vMobile']);
                        $response = ['type' => 1, 'msg' => "Pre-registration Success. Please log in with your credentials to complete the post-registration process."];
                    } else {
                        $response = ['type' => 0, 'msg' => "Please Verify your Email First."];
                    }
                }
            }
        } else {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        }
        return $this->response->setJSON($response);
    }

    public function showPartnerDashboard()
    {
        $pcId = $this->session->get('pcId');
        $data = [
            'ptnrCred' => $this->pc->where('pcId', $pcId)->first(),
            'ptnrData' => $this->pd->where('pcId', $pcId)->first(),
            'ptnrAppl' => $this->pa->where('pcId', $pcId)->find(),
        ];

        echo view('_partner/include');
        return view('_partner/dashboard', $data);
    }

    public function showPartnerPostRegister()
    {
        echo view('_partner/include');
        return view('_partner/postRegister');
    }

    public function validatePartnerPostRegister()
    {
        $predata = [
            "orgName" =>        ["label" => "Organization Name", "rules" => "required"],
            "orgRegDate" =>     ["label" => "Organization Registration Date", "rules" => "required"],
            "orgOprState" =>    ["label" => "Organization Operating State", "rules" => "required"],
            "orgOprDist" =>     ["label" => "Organization Operating District", "rules" => "required"],
            "orgRegNo" =>       ["label" => "Organization Registration Number", "rules" => "required"],
            "orgRegDoc" =>      ["label" => "Organization Registration Document", "rules" => "uploaded[orgRegDoc]|max_size[orgRegDoc,3072]|ext_in[orgRegDoc,pdf]"],
            "orgPresName" =>    ["label" => "Organization President Name", "rules" => "required"],
            "orgSecrName" =>    ["label" => "Organization Secretary Name", "rules" => "required"],
            "orgFcraNo" =>      ["label" => "Organization FCRA Number", "rules" => "permit_empty"],
            "orgFcraDoc" =>     ["label" => "Organization FCRA Document", "rules" => "max_size[orgFcraDoc,3072]|ext_in[orgFcraDoc,pdf]"],
            "orgGstNo" =>       ["label" => "Organization GST Number", "rules" => "permit_empty"],
            "orgGstDoc" =>      ["label" => "Organization GST Document", "rules" => "max_size[orgGstDoc,3072]|ext_in[orgGstDoc,pdf]"],
            "orgRegType" =>     ["label" => "Organization Registration Type", "rules" => "required"],
            "orgNgoType" =>     ["label" => "NGO Type", "rules" => "required"],
            "orgActName" =>     ["label" => "Organization Act Name", "rules" => "required"],
            "orgCityReg" =>     ["label" => "City of Registratioon", "rules" => "required"],
            "orgPanNo" =>       ["label" => "Organization PAN Number", "rules" => "permit_empty"],
            "orgPanDoc" =>      ["label" => "Organization PAN Document", "rules" => "max_size[orgPanDoc,3072]|ext_in[orgPanDoc,pdf]"],
            "orgOtherDoc" =>    ["label" => "Organization PAN Document", "rules" => "max_size[orgPanDoc,3072]|ext_in[orgPanDoc,pdf]"],
            "orgNgoUnqId" =>    ["label" => "NGO Unique ID", "rules" => "permit_empty"],
            "orgMobNo" =>       ["label" => "Organization Mobile Number", "rules" => "required|is_natural|exact_length[10]"],
            "orgEmailId" =>     ["label" => "Organization Email ID", "rules" => "required|valid_email"],
            "orgWebsite" =>     ["label" => "Organization Webiste", "rules" => "permit_empty|valid_url_strict"],
            "orgRegAddr" =>     ["label" => "Organization Full Address", "rules" => "required"],

            "orgCntcName" =>    ["label" => "Contact Person Name", "rules" => "required"],
            "orgCntcAadhar" =>  ["label" => "Contact Person Aadhar Number", "rules" => "required|is_natural|exact_length[4]"],
            "orgCntcMob" =>     ["label" => "Contact Person Mobile Number", "rules" => "required|is_natural|exact_length[10]"],
            "orgCntcEmail" =>   ["label" => "Contact Person Email ID", "rules" => "required|valid_email"],
            "orgCntcPost" =>    ["label" => "Contact Person Post in Organization", "rules" => "required"],
            "orgCntcAddr" =>    ["label" => "Contact Person Full Address", "rules" => "required"],
        ];

        if ($this->validate($predata)) {
            $data = [
                'pcId' =>           $this->session->get('pcId'),
                'orgName' =>        $this->request->getVar('orgName'),
                'orgRegDate' =>     $this->request->getVar('orgRegDate'),
                'orgOprState' =>    $this->request->getVar('orgOprState'),
                'orgOprDist' =>     $this->request->getVar('orgOprDist'),
                'orgRegNo' =>       $this->request->getVar('orgRegNo'),
                'orgPresName' =>    $this->request->getVar('orgPresName'),
                'orgSecrName' =>    $this->request->getVar('orgSecrName'),
                'orgFcraNo' =>      $this->request->getVar('orgFcraNo'),
                'orgGstNo' =>       $this->request->getVar('orgGstNo'),
                'orgRegType' =>     $this->request->getVar('orgRegType'),
                'orgNgoType' =>     $this->request->getVar('orgNgoType'),
                'orgActName' =>     $this->request->getVar('orgActName'),
                'orgCityReg' =>     $this->request->getVar('orgCityReg'),
                'orgPanNo' =>       $this->request->getVar('orgPanNo'),
                'orgNgoUnqId' =>    $this->request->getVar('orgNgoUnqId'),
                'orgMobNo' =>       $this->request->getVar('orgMobNo'),
                'orgEmailId' =>     $this->request->getVar('orgEmailId'),
                'orgWebsite' =>     $this->request->getVar('orgWebsite'),
                'orgRegAddr' =>     $this->request->getVar('orgRegAddr'),

                'orgCntcName' =>    $this->request->getVar('orgCntcName'),
                'orgCntcAadhar' =>  $this->request->getVar('orgCntcAadhar'),
                'orgCntcMob' =>     $this->request->getVar('orgCntcMob'),
                'orgCntcEmail' =>   $this->request->getVar('orgCntcEmail'),
                'orgCntcPost' =>    $this->request->getVar('orgCntcPost'),
                'orgCntcAddr' =>    $this->request->getVar('orgCntcAddr'),
            ];

            $orgRegDoc =    $this->request->getFile('orgRegDoc');
            if ($orgRegDoc->isValid() && !$orgRegDoc->hasMoved()) {
                $new_orgRegDoc = $orgRegDoc->getClientName();
                $new_orgRegDoc = $orgRegDoc->getRandomName();
                $orgRegDoc->move(ROOTPATH . 'uploads/orgRegDoc/', $new_orgRegDoc);

                $data += [
                    'orgRegDoc' => $new_orgRegDoc,
                ];
            }

            $orgGstDoc =    $this->request->getFile('orgGstDoc');
            if ($orgGstDoc->isValid() && !$orgGstDoc->hasMoved()) {
                $new_orgGstDoc = $orgGstDoc->getClientName();
                $new_orgGstDoc = $orgGstDoc->getRandomName();
                $orgGstDoc->move(ROOTPATH . 'uploads/orgGstDoc/', $new_orgGstDoc);

                $data += [
                    'orgGstDoc' => $new_orgGstDoc,
                ];
            }

            $orgPanDoc =    $this->request->getFile('orgPanDoc');
            if ($orgPanDoc->isValid() && !$orgPanDoc->hasMoved()) {
                $new_orgPanDoc = $orgPanDoc->getClientName();
                $new_orgPanDoc = $orgPanDoc->getRandomName();
                $orgPanDoc->move(ROOTPATH . 'uploads/orgPanDoc/', $new_orgPanDoc);

                $data += [
                    'orgPanDoc' => $new_orgPanDoc,
                ];
            }

            $orgTanDoc =    $this->request->getFile('orgTanDoc');
            if ($orgTanDoc->isValid() && !$orgTanDoc->hasMoved()) {
                $new_orgTanDoc = $orgTanDoc->getClientName();
                $new_orgTanDoc = $orgTanDoc->getRandomName();
                $orgTanDoc->move(ROOTPATH . 'uploads/orgTanDoc/', $new_orgTanDoc);

                $data += [
                    'orgTanDoc' => $new_orgTanDoc,
                ];
            }

            $orgOtherDoc =    $this->request->getFile('orgOtherDoc');
            if ($orgOtherDoc->isValid() && !$orgOtherDoc->hasMoved()) {
                $new_orgOtherDoc = $orgOtherDoc->getClientName();
                $new_orgOtherDoc = $orgOtherDoc->getRandomName();
                $orgOtherDoc->move(ROOTPATH . 'uploads/orgOtherDoc/', $new_orgOtherDoc);

                $data += [
                    'orgOtherDoc' => $new_orgOtherDoc,
                ];
            }

            $this->pd_ngo->save($data);

            $response = ['type' => 1, 'msg' => "Your submission is successfull. Please wait for the approval."];
        } else {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        }
        return $this->response->setJSON($response);
    }

    public function partnerApply()
    {
        $data = [
            'pcId' =>       $this->session->get('pcId'),
            'noId' =>       $this->request->getVar('applyNotif'),
            'apState' =>    $this->request->getVar('applyState'),
            'apDistrict' => implode(', ', $this->request->getVar('applyDist')),
        ];
        $this->pa->save($data);

        $response = ['type' => 1, 'msg' => "Your submission is successfull. Please wait for the approval"];

        return $this->response->setJSON($response);
    }

    public function lander_contact()
    {
        $msg =
            '<b>Name:</b> '     . $this->request->getVar('cnTname')     . '<br>'      .
            '<b>Email:</b> '    . $this->request->getVar('cnTemail')    . '<br>'      .
            '<b>Phone:</b> '    . $this->request->getVar('cnTphone')    . '<br>'      .
            '<b>Subject:</b> '    . $this->request->getVar('cnTsubject')  . '<br><br>'  .

            '<b>Message:</b> '  . $this->request->getVar('cnTmessage');
        $this->send_mail('contact@sgproject.in', 'Message from SG Project', 'You received a Message from,<br><br>' . $msg);
        $this->send_mail($this->request->getVar('cnTemail'), 'Message from SG Project', 'Your Message details has been listed below,<br><br>' . $msg);
    }

    public function send_otp()
    {
        $eOTP = random_string('numeric', 6);
        $mOTP = random_string('numeric', 6);
        $rcvr = $this->request->getVar('OTPrcvr');

        if ($this->request->getVar('OTPtype') == "Email") {
            if (empty($rcvr)) {
                $response = ['type' => 0, 'msg' => "You forgot to enter your Email ID."];
            } else {
                $this->send_mail($rcvr, 'OTP for Email Verification', 'Your OTP for Email Verification is ' . $eOTP);

                $this->session->set('sEmail', $eOTP);
                $response = ['type' => 1, 'vE' => TRUE, 'msg' => $eOTP,];
            }
        } else if ($this->request->getVar('OTPtype') == "Mobile") {
            if (empty($rcvr)) {
                $response = ['type' => 0, 'msg' => "You forgot to enter your Mobile Number."];
            } else {
                // $apiKey = urlencode('NTgzMzY2NzE1NDc5MzkzODM2NzI1OTU1NGU1MjQxNTc=');

                $this->session->set('sMobile', $mOTP);
                $response = ['type' => 1, 'vM' => TRUE, 'msg' => $mOTP,];
            }
        }
        return $this->response->setJSON($response);
    }

    public function verify_otp()
    {
        if ($this->request->getVar('OTPtype') == "Email") {
            if ($this->session->get('sEmail') == $this->request->getVar('OTPData')) {
                $response = ['type' => 1, 'vE' => TRUE, 'msg' => 'Email verified successfully.',];
                $this->session->set(['vEmail' => TRUE,]);
            } else {
                $response = ['type' => 0, 'msg' => 'Wrong OTP Entered.',];
            }
        } else if ($this->request->getVar('OTPtype') == "Mobile") {
            if ($this->session->get('sMobile') == $this->request->getVar('OTPData')) {
                $response = ['type' => 1, 'vM' => TRUE, 'msg' => 'Mobile verified successfully.',];
                $this->session->set(['vMobile' => TRUE,]);
            } else {
                $response = ['type' => 0, 'msg' => 'Wrong OTP Entered.',];
            }
        }
        return $this->response->setJSON($response);
    }

    public function bulkMailer()
    {
        $num = 0;
        if (($handle      = fopen(ROOTPATH . 'uploads/bulkMailFile/list.csv', "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $this->send_mail($data[15], 'Work with SG Projects as a partner', view("_partner/emailTemp/bulkMailerFromFile"));
                $num++;
            }

            fclose($handle);
            echo "<h2>Total Mail sent : " . $num . "</h2>";
        }
    }

    public function send_mail($to, $sub, $msg)
    {
        $this->email->setTo($to);
        $this->email->setFrom('info@sgproject.in', 'SG Projects');
        $this->email->setSubject($sub);
        $this->email->setMessage($msg);
        $this->email->send();
    }

    public function logout()
    {
        $this->session->remove(['pcId', 'pOrgType', 'partnerLogged_in']);
        return redirect()->to(base_url('/'));
    }
}

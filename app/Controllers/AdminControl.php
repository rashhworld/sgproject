<?php

namespace App\Controllers;

class AdminControl extends BaseController
{

    public function showAdminAuth()
    {
        echo view('_partner/include');
        return view('_admin/auth');
    }

    public function validateAdminLogin()
    {
        if (!$this->validate(["aEmail" => ["label" => "Email", "rules" => "trim|required|valid_email"], "aPass" => ["label" => "Password", "rules" => "trim|required"]])) {
            $response = ['type' => 0, 'msg' => $this->validator->listErrors(),];
        } else {
            $aEmail = $this->request->getVar('aEmail');
            $aPass = $this->request->getVar('aPass');
            $data = $this->ac->where('aEmail', $aEmail)->first();
            if ($data) {
                if (password_verify($aPass, $data['aPass'])) {
                    $this->session->set(['aEmail' => $data['aEmail'], 'aAccessType' => $data['aAccessType'], 'adminLogged_in' => TRUE]);
                    $response = ['type' => 1, 'url' => base_url('admin/dashboard')];
                } else {
                    $response = ['type' => 0, 'msg' => 'Wrong Password Entered!'];
                }
            } else {
                $response = ['type' => 0, 'msg' => 'No User Exist with this Email!'];
            }
        }
        return $this->response->setJSON($response);
    }

    public function showAdminDashboard()
    {
        $data = [
            // 'ptnrData' => $this->pc->orderBy("pRegDate", "desc")->find();
        ];

        echo view('_partner/include');
        return view('_admin/dashboard', $data);
    }

    public function partnerDetails()
    {
        $ptnrId = $this->request->uri->getSegment(3);
        $data['orgType'] = $this->request->uri->getSegment(4);

        switch ($data['orgType']) {
            case '1':
                $data['ptnrDetails'] = $this->pd_ngo->where('pcId', $ptnrId)->first();
                break;
            case '2':
                $data['ptnrDetails'] = $this->pd_pvtltd->where('pcId', $ptnrId)->first();
                break;
            case '3':
                $data['ptnrDetails'] = $this->pd_llp->where('pcId', $ptnrId)->first();
                break;
            case '4':
                $data['ptnrDetails'] = $this->pd_ptsp->where('pcId', $ptnrId)->first();
                break;
        }

        echo view('_partner/include');
        if ($data['ptnrDetails'] == NULL) {
            print "<p class='position-absolute top-50 start-50 translate-middle text-center text-white fs-2'>No details found.<br>Applicant may have partial submitted..</p>";
        } else {
            return view('_admin/partnerDetails', $data);
        }
    }
    
    public function partnerApplic()
    {
        $applicData = $this->pa->where('pcId', $this->request->getVar('ptnrID'))->find();
        return $this->response->setJSON($applicData);
    }

    public function emailPartner()
    {
        $this->send_mail($this->request->getVar('pEmail'), 'Message from SG Projects', view("_partner/emailTemp/emailPartnerSelf", ['pMessage' => $this->request->getVar('pMessage')]));
        return $this->response->setJSON(['msg' => 'Message Sent Successfully.']);
    }

    public function deletePartner()
    {
        $this->pc->where('pcId', $this->request->getVar('pcId'))->delete();
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
        $this->session->remove(['aEmail', 'adminLogged_in']);
        return redirect()->to(base_url('admin/auth/'));
    }
}

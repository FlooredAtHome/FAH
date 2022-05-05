<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;

class ResetPassword extends Controller
{
    public $loginModel;
    public $session;
    public function __construct() {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();

    }
    public function reset_password_view()
    {
        return view("reset_password_view");
    }

    public function reset_password()
    {
        $data = [];
        $EMAIL = $this->request->getPost('EMAIL');
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        if(!empty($userdata))
        {
            if($this->loginModel->updatedAt($userdata['UID']))
            {
                $to = $EMAIL;
                $subject = 'Reset Password Link';
                $token = $userdata['EMAIL'];
                $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                        . 'Your reset password request has been  received. Please click'
                        . 'the below link to reset your password.<br><br>'
                        . '<a href="'.base_url('FAH/login/reset_password/'.$token.'').'">Click here to reset password</a><br><br>'
                        . 'Thanks<br>Floored At Home';
                $EMAIL = \Config\Services::email();
                $EMAIL->setTo($to);
                $EMAIL->setFrom('maheksavanicoc1@gmail.com','Floored At Home');
                $EMAIL->setSubject($subject);
                $EMAIL->setMessage($message);
                if($EMAIL->send())
                {
                    session()->setTempdata('success','Reset password link sent to your registerd email. Please verify within 10 minutes.',3);
                    return redirect()->to("FAH");
                }
            }
            else
            {
                $this->session->setTempdata('error','Here Vatsal',3);
                return redirect()->to("FAH");
            }
        }
        else
        {
            $this->session->setTempdata('error','Sorry! Email does not exists',3);
            return redirect()->to("FAH");
        }
    }



}
?>
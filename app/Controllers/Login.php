<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use CodeIgniter\I18n\Time;

class Login extends Controller
{
    public $loginModel;
    
    public function __construct() {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();
    }
    // public function user()
    // {
    //     if($this->session->get('email') != '')
    //     {
    //         print_r($this->session->get('roleid'));
    //         if($this->session->get('roleid') == 1){
    //             return redirect()->to(base_url('FAH/Admin/index'));
    //         }
    //         if($this->session->get('roleid') == 2){
    //             return redirect()->to(base_url('FAH/UserHome/vendor_home'));
    //         }
    //         if($this->session->get('roleid') == 3){
    //             return redirect()->to(base_url('FAH/UserHome/user_home'));
    //         }
    //     }
    //     else
    //     {
    //         echo view('Login/user');
    //     }
    // }
    public function reset_password_view()
    {
        return view("Login/reset_password_view");
    }
    public function verify()
    {
        $data = [];
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'EMAIL' => 'required|valid_email',
                'PASSWORD' => 'required',
            ];
            if($this->validate($rules))
            {
                $EMAIL = $this->request->getPost('EMAIL');
                $PASSWORD = $this->request->getPost('PASSWORD');
                $userdata = $this->loginModel->verifyEmail($EMAIL);
                if($userdata)
                {
                    if($PASSWORD == $userdata['PASSWORD'])
                    {
                        $log_time = time();
                        $newdata = [
                            'email'  =>  $EMAIL,
                            'logged_in_time' => $log_time,
                            
                        ];
                        
                        if($userdata['RID'] == '3')
                        {
                            echo $log_time;
                            $this->session->set($newdata);
                            if($this->session->get('email')!=''){
                                return redirect()->to(base_url('FAH/UserHome/user_home'));
                            }
                        }
                        else if($userdata['RID'] == '2')
                        {
                            echo "Welcome Vendor";
                        }
                        else if($userdata['RID'] == '1')
                        {
                            //$this->session->destroy();
                            echo $log_time;
                            $this->session->set($newdata);
                            if($this->session->get('email')!='')
                            {
                                return redirect()->to(base_url('FAH/Admin/index'));
                            }
                        }
                     
                    }
                    else
                    {
                        $this->session->setTempdata('error','Sorry! Wrong password entered for that email',3);
                        return redirect()->to(base_url('FAH'));
                    }
                }
                else
                {
                    $this->session->setTempdata('error','Sorry! Email does not exists',3);
                    return redirect()->to(base_url('FAH'));
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }        
    }
    public function logout(){
        $this->session->remove('email');
        if($this->session->remove('email')==''){
            return redirect()->to(base_url('FAH'));
        }
       
    }
    // public function reset_password()
    // {
    //     $data = [];
    //     $EMAIL = $this->request->getPost('EMAIL');
    //     $userdata = $this->loginModel->verifyEmail($EMAIL);
    //     if(!empty($userdata))
    //     {
    //         if($this->loginModel->updatedAt($userdata['UID']))
    //         {
    //             $to = $EMAIL;
    //             $subject = 'Reset Password Link';
    //             $token = $userdata['UID'];
    //             $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].','.'<br><br>'
    //                     . 'Your reset password request has been received. Please verify within 60 minutes. Please click '
    //                     . 'the below link to reset your password.<br><br>'
    //                     . '<a href="'.base_url().'/FAH/Login/change_pwd/'.$token.'">Click here to reset password</a><br><br>'
    //                     . 'Thanks<br>Floored At Home';
    //             $email = \Config\Services::email();
    //             $email->setTo($to);
    //             $email->setFrom('fahresethelp@gmail.com','Floored At Home');
    //             $email->setSubject($subject);
    //             $email->setMessage($message);
    //             $email->attach('C:\Users\PD\Downloads\users.pdf');
    //             if($email->Send())
    //             {
    //                 $this->session()->setTempdata('success','Reset password link sent to your registerd email. Please verify within 60 minutes.',3);
    //                 return redirect()->to(base_url('FAH/Login/reset_password_view'));
    //             }
    //         }
    //         else
    //         {
    //             $this->session->setTempdata('error','Unable to update. Please try again',3);
    //             return redirect()->to(base_url('FAH/Login/reset_password_view'));
    //         }
    //     }
    //     else
    //     {
    //         $this->session->setTempdata('error','Sorry! Email does not exists',3);
    //         return redirect()->to(base_url('FAH/Login/reset_password_view'));
    //     }
    // }

    public function change_pwd($uid){
        // $uemail = $this->input->get('email');
        $uid = $uid;
        // $data = $this->loginModel->pwd_change_verify($uemail,$uid);
        // if($data){
        //     echo view(base_url('Login/change_pwd'),$uid);
        // }
        // else{
        //     echo "Error";
        // }
        echo view('Login/change_pwd', ["uid"=>$uid]);
    }
    public function update_password(){
        $uid= $this->request->getPost('UID');
        $npass = $this->request->getPost('npwd');
        $cpass = $this->request->getPost('cpwd');
        if($npass == null || $cpass==null){
            echo "Fatal Error";
        }
        else{
            $data = $this->loginModel->updatepass($npass,$uid);
        }
        
    }
    public function user_home(){
        if($this->session->get('email')!=''){
        echo view("templates/header");
        echo view("home/user_home");
        }
        else{
            return redirect()->to(base_url('FAH'));
        }
    }
}
?>
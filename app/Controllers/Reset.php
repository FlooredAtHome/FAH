<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\RequestInterface;
class Reset extends Controller
{
    public $loginModel;
    public $request;

    public function __construct() {
        helper('url');
        helper('form');  
        $this->loginModel = new LoginModel(); 
    }
    public function index(){
        $uri = new \CodeIgniter\HTTP\URI();
        $request = \Config\Services::request();
        $uemail=$request->getVar('email');
        $uuid=$request->getVar('uid');
        
        $val = $this->loginModel->pwd_change_verify($uemail,$uuid);
        if($val){
            $data['email']=$uemail;
            $data['uid']=$uuid;
            echo view('reset/header');
            echo view('reset/change_pwd',$data);
        }
        else{
            echo "Error";
        }
    }

    public function update_password(){
        $uid= $this->request->getPost('uid');
        $npass = $this->request->getPost('npwd');
        $cpass = $this->request->getPost('cpwd');
        if($npass == null || $cpass==null){
            echo "Fatal Error";
        }
        else{
            $data = $this->loginModel->updatepass($npass,$uid);
            if($data){
                return redirect()->to(base_url('FAH'));
            }
            else{
                echo "Fatal Error";
            }
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
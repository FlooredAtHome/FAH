<?php

namespace App\Controllers;

use Exception;
use App\Models\APIModel;
use App\Models\APILoginModel;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;
use CodeIgniter\I18n\Time;

class FahAPI extends ResourceController
{
    public function view($id = ""){
        if(empty($id)){
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
        else{
            $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9";
            $authHeader = $this->request->getHeader("Authorization");
            $authHeader = $authHeader->getValue();
            $model = new APIModel();
            if ($authHeader == $key) {
                $data = $model->viewUser($id);
                foreach($data as $row){
                    $response = [
                        'UID' => $row["UID"],
                        'Email' => $row["EMAIL"],
                        'First Name' => $row["FIRST_NAME"],
                        'Last Name' => $row["LAST_NAME"],
                        'Password Update Time' => $row["PASS_UPDATE_TIME"]
                    ];
                    echo "{<br> 'UID'=>'".$row["UID"]."',<br>'Email'=>'".$row["EMAIL"]."',<br>'First Name'=>'".$row["FIRST_NAME"]."'<br>'Last Name'=>'".$row["LAST_NAME"]."'<br>'Password Update Time'=>'".$row["PASS_UPDATE_TIME"]."'<br>}<br><br>";
                }
            }
            else{
                echo "Invalid Key. Generate Key Again!!";
            }
        }
    }
    public function create($role = '')
    {
        if($role == 'vendor' || $role == 'customer'){
        $roleuser =['vendor' => '2', 'customer' => '3'];
        $key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9";
        $authHeader = $this->request->getHeader("Authorization");
        $token = $authHeader->getValue();
            if ($key == $token) {
                $rules = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|is_unique[users.EMAIL]|valid_email',
                    'zcid' => 'required'
                ];
                if(!$this->validate($rules))
                {
                    return $this->fail($this->validator->getErrors());
                }
                else
                {
                    $userdata = [
                        'FIRST_NAME' => $this->request->getVar('first_name'),
                        'LAST_NAME' => $this->request->getVar('last_name'),
                        'RID' => $roleuser[$role],
                        'EMAIL' => $this->request->getVar('email')
                    ];
                    $model = new APIModel();
                    $model->save($userdata);
                    $projectdata = [
                        'ZC_ID' => $this->request->getVar('zcid')
                    ];
                    $model->insertId($roleuser[$role],$userdata['EMAIL'],$projectdata['ZC_ID']);
                    $token = $model->getUserData($userdata['EMAIL']);
                    // EMAIL on Create
                    // $to = $userdata["EMAIL"];
                    // $subject = 'Reset Password Link';
                    // $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].','.'<br><br>'
                    //         . 'Your FAH account has been created. In order to access the account, please verify within 60 minutes. Please click '
                    //         . 'the below link to setup your account.<br><br>'
                    //         . '<a href="'.base_url().'/FAH/Login/change_pwd/'.$token.'">Click here to reset password</a><br><br>'
                    //         . 'Thanks<br>Floored At Home';
                            
                    // $email = \Config\Services::email();
                    // $email->setTo($to);
                    // $email->setFrom('vaghasia84@gmail.com','Floored At Home');
                    // $email->setSubject($subject);
                    // $email->setMessage($message);
                    // $email->attach('C:\Users\PD\Downloads\users.pdf');
                    // print_r($userdata["EMAIL"]);
                    // if($email->send())
                    // {
                        $message = [
                            'status' => 201,
                            'message' => 'User inserted successfully'
                        ];
                        return $this->respondCreated($message);
                    // }
                    // else
                    // {
                    //     $response = [
                    //         'status' => 502,
                    //         'error' => true,
                    //         'messages' => 'Bad Gateway',
                    //         'data' => []
                    //     ];
                    //     return $this->respondCreated($response);
                    // }
                    
                }
            }
        }
        else{
            $response = [
                'status' => 401,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
        }
    }
}

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
    private function getKey()
    {
        return "mahek";
    }

    public function login()
    {
        $rules = [
            "email" => "required|valid_email|min_length[6]",
            "password" => "required",
        ];

        $messages = [
            "email" => [
                "required" => "Email required",
                "valid_email" => "Email address is not in format"
            ],
            "password" => [
                "required" => "password is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status' => 500,
                'error' => true,
                'message' => $this->validator->getErrors(),
                'data' => []
            ];

            return $this->respondCreated($response);
            
        } else {
            $apiloginModel = new APILoginModel();

            $userdata = $apiloginModel->where("email", $this->request->getVar("email"))->first();

            if (!empty($userdata)) {

                $password = $this->request->getVar("password");
                if ($password == $userdata['password']) {

                    $key = $this->getKey();

                    $iat = time(); // current timestamp value
                    $nbf = $iat + 10;
                    $exp = $iat + 3600;

                    $payload = array(
                        "iss" => "The_claim",
                        "aud" => "The_Aud",
                        "iat" => $iat, // issued at
                        "nbf" => $nbf, //not before in seconds
                        "exp" => $exp, // expire time in seconds
                        "data" => $userdata,
                    );

                    $token = JWT::encode($payload, $key);

                    $response = [
                        'status' => 200,
                        'error' => false,
                        'messages' => 'User logged In successfully',
                        'data' => [
                            'token' => $token
                        ]
                    ];
                    return $this->respondCreated($response);
                } else {

                    $response = [
                        'status' => 500,
                        'error' => true,
                        'messages' => 'Incorrect details',
                        'data' => []
                    ];
                    return $this->respondCreated($response);
                }
            } else {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'messages' => 'User not found',
                    'data' => []
                ];
                return $this->respondCreated($response);
            }
        }
    }

    public function create($role = '')
    {
        if($role == '2' || $role == '3'){
        $key = $this->getKey();
        $authHeader = $this->request->getHeader("Authorization");
        $authHeader = $authHeader->getValue();
        $token = $authHeader;
    
        try {
            $decoded = JWT::decode($token, $key, array("HS256"));
            if ($decoded) {
                    // print_r($decoded);
                // $rules = [
                //     'first_name' => 'required',
                //     'last_name' => 'required',
                //     'email' => 'required|is_unique[users.EMAIL]|valid_email',
                //     'zcpoid' => 'required'
                // ];
        
                // if(!$this->validate($rules))
                // {
                //     return $this->fail($this->validator->getErrors());
                // }
                // else
                // {
                    $userdata = [
                        'FIRST_NAME' => $this->request->getVar('first_name'),
                        'LAST_NAME' => $this->request->getVar('last_name'),
                        'RID' => $role,
                        'EMAIL' => $this->request->getVar('email')
                    ];
                    $projectdata = [
                        'ZC_PO_ID' => $this->request->getVar('zcpoid')
                    ];
                    
                    $model = new APIModel();
                    $model->save($userdata);
                    $model->insertId($userdata['EMAIL'],$projectdata['ZC_PO_ID']);
                    $token = $model->getUserData($userdata['EMAIL'],$projectdata['ZC_PO_ID']);
                    // EMAIL on Create
                    $to = $userdata["EMAIL"];
                    $subject = 'Reset Password Link';
                    $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].','.'<br><br>'
                            . 'Your FAH account has been created. In order to access the account, please verify within 60 minutes. Please click '
                            . 'the below link to setup your account.<br><br>'
                            . '<a href="'.base_url().'/FAH/Login/change_pwd/'.$token.'">Click here to reset password</a><br><br>'
                            . 'Thanks<br>Floored At Home';
                            
                    $email = \Config\Services::email();
                    $email->setTo($to);
                    $email->setFrom('vaghasia84@gmail.com','Floored At Home');
                    $email->setSubject($subject);
                    $email->setMessage($message);
                    // $email->attach('C:\Users\PD\Downloads\users.pdf');
                    print_r($userdata["EMAIL"]);
                    if($email->send())
                    {
                        $message = [
                            'status' => 201,
                            'message' => 'User inserted successfully'
                        ];
                        return $this->respondCreated($message);
                    }
                    else
                    {
                        $response = [
                            'status' => 502,
                            'error' => true,
                            'messages' => 'Bad Gateway',
                            'data' => []
                        ];
                        return $this->respondCreated($response);
                    }
                    
                }
                // print_r($userdata["EMAIL"]);
            // }
        } catch (Exception $ex) {
          
            $response = [
                'status' => 405,
                'error' => true,
                'messages' => 'Access denied',
                'data' => []
            ];
            return $this->respondCreated($response);
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

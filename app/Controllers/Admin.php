<?php

namespace App\Controllers;
use App\Models\CustomerModel;
use App\Models\VendorModel;
use App\Models\LoginModel;
use App\Models\ProjectModel;
use App\Models\TimingModel;
use App\Models\CommentModel;
use App\Models\APIModel;
use App\Models\APILoginModel;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;


use CodeIgniter\Controller;

class Admin extends Controller
{
    function __construct() 
    {
        $this->rc = new ResourceController();
        $this->loginModel = new LoginModel();
        $this->customerModel = new CustomerModel();
        $this->vendorModel = new VendorModel();
        $this->commentModel = new CommentModel();
        $this->timingModel = new TimingModel();
        $this->projectModel = new ProjectModel();
        $this->session = session();
        
    }
    public function check(){
        if($this->session->get('email') == '' && $this->session->get('roleid') == '' || $this->session->get('roleid') != '1'){
            $this->session->destroy();
            echo view('Login/user');
            exit;
        }
    }
    public function index()
    {
            $data["email"] = $this->session->get('email');
            $data["role"] = $this->session->get('roleid');
            $customerdata = $this->customerModel->customerDetails($data["email"]);
            $vendordata = $this->vendorModel->vendorDetails($data["email"]);
            echo view("templates/header");
            echo view("templates/navbar",["data"=>$data]);
            echo view("Admin/admin", ["customerdata"=>$customerdata, "vendordata"=>$vendordata]);
    }
    public function updateCustomer()
    {
        if($this->request->getMethod() == 'post')
        {
            $UID = $this->request->getPost('uid');
            $FIRST_NAME = $this->request->getPost('newfirstname');
            $LAST_NAME = $this->request->getPost('newlastname');
            $EMAIL = $this->request->getPost('newemail');
            $result = $this->customerModel->customerUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL);
            if($result == true)
            {
                $this->session->setTempdata('successcust','Details updated successfully!',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
            else
            {
                $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
            return redirect()->to(base_url('FAH/Admin/index'));
        }
    }
    public function updateVendor()
    {
        if($this->request->getMethod() == 'post')
        {
            $UID = $this->request->getPost('uid');
            $FIRST_NAME = $this->request->getPost('newfirstname');
            $LAST_NAME = $this->request->getPost('newlastname');
            $EMAIL = $this->request->getPost('newemail');
            $result = $this->vendorModel->vendorUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL);
            if($result == true)
            {
                $this->session->setTempdata('successvend','Details updated successfully!',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
            return redirect()->to(base_url('FAH/Admin/index'));
        }
    }
    public function insertVendor()
    {
        if($this->request->getMethod() == 'post')
        {
            $FIRST_NAME = $this->request->getPost('firstname');
            $LAST_NAME = $this->request->getPost('lastname');
            $EMAIL = $this->request->getPost('email');
            $RID = '2';
            $result = $this->vendorModel->insertVendor($FIRST_NAME,$LAST_NAME,$EMAIL,$RID);
            if($result == true)
            {
                $this->session->setTempdata('successvend','Vendor inserted successfully!',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
    }
    public function resetpasswordcustomerLink()
    {
        if($this->request->getMethod() == 'post')
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
                    $token = $userdata['UID'];
                    $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                            . 'Your reset password request has been  received. Please click'
                            . 'the below link to reset your password.<br><br>'
                            . '<a href="'.base_url('/login/reset_password()').''.$token.'">Click here to reset password</a><br><br>'
                            . 'Thanks<br>Floored At Home';
                    $EMAIL = \Config\Services::email();
                    $EMAIL->setTo($to);
                    $EMAIL->setFrom('maheksavanicoc1@gmail.com','Floored At Home');
                    $EMAIL->setSubject($subject);
                    $EMAIL->setMessage($message);
                    if($EMAIL->send())
                    {
                        session()->setTempdata('successcust','Reset password link sent to registered email.',3);
                        return redirect()->to(base_url('FAH/Admin/index'));
                    }
                }
                else
                {
                    $this->session->setTempdata('errorcust','Unable to update. Please try again',3);
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
            }
            else
            {
                $this->session->setTempdata('errorcust','Sorry! Email does not exists',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            $this->session->setTempdata('errorcust','Sorry! Try again after some time.',3);
            return redirect()->to(base_url('FAH/Admin/index'));
        }
    }
    public function resetpasswordvendorLink()
    {
    if($this->request->getMethod() == 'post')
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
                $token = $userdata['UID'];
                $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                        . 'Your reset password request has been  received. Please click'
                        . 'the below link to reset your password.<br><br>'
                        . '<a href="'.base_url('/login/reset_password()').''.$token.'">Click here to reset password</a><br><br>'
                        . 'Thanks<br>Floored At Home';
                $EMAIL = \Config\Services::email();
                $EMAIL->setTo($to);
                $EMAIL->setFrom('vaghasia84@gmail.com','Floored At Home');
                $EMAIL->setSubject($subject);
                $EMAIL->setMessage($message);
                if($EMAIL->send())
                {
                    session()->setTempdata('successvend','Reset password link sent to registered email.',3);
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
                else{
                    return redirect()->to(base_url('FAH/Admin/index'));
                }
            }
            else
            {
                $this->session->setTempdata('errorvend','Unable to update. Please try again',3);
                return redirect()->to(base_url('FAH/Admin/index'));
            }
        }
        else
        {
            $this->session->setTempdata('errorvend','Sorry! Email does not exists',3);
            return redirect()->to(base_url('FAH/Admin/index'));
        }
    }
    else
    {
        $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
        return redirect()->to(base_url('FAH/Admin/index'));
    }
    }
    public function getRecordById($module,$pid,$token)
    {
        $headers = array('Authorization: Zoho-oauthtoken '.$token);
	    $ch = curl_init('https://www.zohoapis.com/crm/v2/'.$module.'/'.$pid);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
    	$response = curl_exec($ch);
    // 	error_log($response);
    	curl_close($ch);
    	$json_for_get_record = json_decode($response, true);
        $record_data = $json_for_get_record["data"][0] ;
    	return $record_data;
            
    }

    public function searchRecords($module,$criteria,$token)
    {

        //print_r($criteria);
        $headers = array('Authorization: Zoho-oauthtoken '.$token);
        $ch = curl_init('https://www.zohoapis.com/crm/v2/'.$module.'/search?criteria='.urlencode($criteria));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
        $response = curl_exec($ch);
        curl_close($ch);
        $json_for_search_response = json_decode($response, true);

	return $json_for_search_response;
    }
    public function customerView()
    {
        if($this->session->get("roleid")=="1"){
            $data['role'] = $this->session->get("roleid");
            $data['email'] = $this->session->get("email");
            $data['page'] = "customerView";
            $userdata = $this->loginModel->verifyEmail($data['email']);
            $UID = intval($_GET['id']);
            $details = $this->loginModel->getDetails($UID);
            $pid = $details['PID'];
            $projectdata = $this->projectModel->projectDetails($UID);
            $ZC_PO_ID = $projectdata['ZC_PO_ID'];
            //Edit by Vatsal
            // if(isset($projectdata['ZC_PO_ID']) && !empty($projectdata['ZC_PO_ID'])){
            //     $ZC_PO_ID = $projectdata['ZC_PO_ID'];
            // }
            // else{
            //     $ZC_PO_ID = "";
            // }
            

            $model = new CommentModel();
            $logs = $this->timingModel->displayall($UID);
            $comments = $model->get_comments($pid);
            $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
            $po_data = $this->getRecordById("Deals",$ZC_PO_ID,$token);
            $mp_images = $this->searchRecords("Magicplan_Images","((Potential:equals:".$ZC_PO_ID.")and(Type:equals:Outside Picture))",$token) ;
            
            
            $proposals = $this->searchRecords("Quotes","(Deal_Name:equals:".$ZC_PO_ID.")",$token);
            
            $proposal = [];
            $url = [];
            foreach($proposals['data'] as $proposal)
            {
                if($proposal['Ready_To_Send']!=NULL)
                {
                    $url[$proposal['id']] = $proposal['PandaDoc_PDF'];
                }
            }
            if($mp_images != null  && count($mp_images) > 0 )
            {
                if(strlen($mp_images["data"][0]["Image_URL"])>0)
                {
                    $mp_image_url = $mp_images["data"][0]["Image_URL"];
                }
                else
                {
                    $mp_image_url = base_url('public/assets/images/No_Image_Available.jpg');
                }
            }
            else
            {
                $mp_image_url = base_url('public/assets/images/No_Image_Available.jpg');;
            }
            $email = $po_data["Owner"]["email"];
            $mname = $po_data["Owner"]["name"];
            echo view('templates/header',["data" => $data]);
            echo view('templates/navbar',["data" => $data]);
            echo view('Admin/customerView',["pid"=>$pid,"comments"=>$comments,"LOGS"=>$logs,"po_data"=>$po_data,"mp_image_url"=>$mp_image_url,"email"=>$data['email'],"name"=>$mname,"urls"=>$url]);
        }
        else{
            return redirect()->to(base_url('FAH'));
        }
        
    }
    public function add_comment() 
    {
		if('post' === $this->request->getMethod() && $this->request->getPost('comment_text')) 
        {
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $pid = $this->request->getPost('content_id');
            $parent_id = $this->request->getPost('reply_id');
            $comment_text = $this->request->getPost('comment_text');
            $data = array(
                'comment_text' => $comment_text,
                'commenter' => $userdata['FIRST_NAME']." ".$userdata['LAST_NAME'],
                'parent_id' => $parent_id,
                'comment_date' => date('Y-m-d h:i:sa'),
                'pid' => $pid
            );
			
			$model = new CommentModel();
            $resp = $model->add_comment($data);
            
            // if ($resp != NULL) 
            // {
            //     foreach ($resp as $row) 
            //     {
            //         $date=date_create($row->comment_date);
            //         $time=date_format($date,"F j, Y, g:i a");
            //     //    $date = mysqli_to_php_date($row->comment_date);

                    

            //         // $response = [
            //         //     'status' => 200,
            //         //     'error' => false,
            //         //     'messages' => 'Comment added successfully',
            //         //     'data' => [
            //         //         'msg' => "Done"
            //         //     ]
            //         // ];
            //         // return $this->rc->respondCreated($response);
            //         echo "<li id=\"li_comment_{$row->comment_id}\">" .
            //         "<div><span class=\"commenter\">{$row->commenter}</span><span class=\"comment_date\">{$time}</span></div>".
            //         "<div style=\"margin-top:4px;margin-bottom:20px;\">{$row->comment_text}<a href=\"#\" class=\"reply_button text-decoration-none fa fa-reply\" style=\"font-size:28px;color:#182c6d\" id=\"{$row->comment_id}\"></a></div>" .
            //         "</li>";
            //     }
            // } else {
            //     echo 'Error in adding comment';
            // }
        } else {
            echo 'Error: Please enter your comment';
        }
    }
    public function Logloadhandler()
    {
        $temp1_1 = file_get_contents('php://input',true);
        $temp1 = json_decode($temp1_1,true);
        $uid= $temp1[0]["uid"];
        $rep = $temp1[0]["rep"];
        var_dump($rep);
    }

    public function vendorView()
    {
        if($this->session->has("email"))
        {

            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $UID = intval($_GET['id']);
            $details = $this->loginModel->getDetails($UID);
            $pid = $details['PID'];
			$projectdata = $this->projectModel->projectDetails($UID);
            $ZC_PO_ID = $projectdata['ZC_PO_ID'];
            $model = new CommentModel();
            $logs = $this->timingModel->displayall($UID);
            $comments = $model->get_comments($pid);
			$token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
            $po_data = $this->getRecordById("Deals",$ZC_PO_ID,$token);
            $mp_images = $this->searchRecords("Magicplan_Images","((Potential:equals:".$ZC_PO_ID.")and(Type:equals:Outside Picture))",$token) ;
            $proposals = $this->searchRecords("Quotes","(Deal_Name:equals:".$ZC_PO_ID.")",$token);
            $proposal = [];
            $url = [];
            foreach($proposals['data'] as $proposal)
            {
                if($proposal['Ready_To_Send']!=NULL)
                {
                    $url[$proposal['id']] = $proposal['PandaDoc_PDF'];
                }
            }
			if(count($mp_images) > 0 )
            {
                if(strlen($mp_images["data"][0]["Image_URL"])>0)
                {
                    $mp_image_url = $mp_images["data"][0]["Image_URL"];
                }
				else
            	{
                	$mp_image_url = base_url('public/assets/images/No_Image_Available.jpg');
            	}
            }
			$email = $po_data["Owner"]["email"];
			$mname = $po_data["Owner"]["name"];
            echo view('Admin/customerView',["pid"=>$pid,"comments"=>$comments,"LOGS"=>$logs,"po_data"=>$po_data,"mp_image_url"=>$mp_image_url,"email"=>$email,"name"=>$mname,"urls"=>$url]);
        }
        else
        {
            return redirect()->to(base_url('/'));
        }
    }
}

?>
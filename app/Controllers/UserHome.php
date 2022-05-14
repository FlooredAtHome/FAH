<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoginModel;
use App\Models\ResetTokenModel;
use App\Models\ProjectModel;
use App\Models\CommentModel;
use App\Models\TimingModel;
use App\Models\VendorModel;
use CodeIgniter\I18n\Time;

class UserHome extends Controller
{
    public $loginModel;
    
    public function __construct() {
        $this->timingModel = new TimingModel();
        helper('form');
        $this->resetToken = new resetTokenModel();
        $this->loginModel = new LoginModel();
        $this->projectModel = new ProjectModel();
        $this->commentModel = new CommentModel();
        $this->vendorModel = new vendorModel();
        $this->session = session();
        if($this->session->get('email') != '')
        {
            if($this->session->get('roleid') == 1){
                return redirect()->to(base_url('FAH/Admin/index'));
            }
            if($this->session->get('roleid') == 2){
                return redirect()->to(base_url('FAH/UserHome/vendor_home'));
            }
            if($this->session->get('roleid') == 3){
                return redirect()->to(base_url('FAH/UserHome/user_home'));
            }
        }
    }
    // public function check(){
    //     if($this->session->get('email') == '' && $this->session->get('roleid') == '' && $this->session->get('roleid') != '2' && $this->session->get('roleid') != '3'){
    //         $this->session->destroy();
    //         echo view('Login/user');
    //         exit;
    //     }
    // }
    public function proptime(){
        $EMAIL=$this->session->get('email');
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        $uid=$userdata['UID'];
        $model = new TimingModel();
        $this->timingModel->timeclick($uid);
        exit;
    }
    public function JSONhandler(){
        $temp1_1 = file_get_contents('php://input',true);
        $temp1 = json_decode($temp1_1,true);
        $EMAIL= $temp1[0]["email"];
        $proptime = $temp1[0]["proptime"];
        $clicked = $temp1[0]["clicked"];
        $userdata = $this->loginModel->verifyEmail($EMAIL);
        $uid=$userdata['UID'];
        $this->timingModel->timeclick($uid,$EMAIL,$proptime,$clicked);
        exit;
    }

    public function user()
    {
        if($this->session->get('email') != '')
        {
            if($this->session->get('roleid') == 1){
                return redirect()->to(base_url('FAH/Admin/index'));
            }
            if($this->session->get('roleid') == 2){
                return redirect()->to(base_url('FAH/UserHome/vendor_home'));
            }
            if($this->session->get('roleid') == 3){
                return redirect()->to(base_url('FAH/UserHome/user_home'));
            }
        }
        else
        {
            echo view('templates/header');
            echo view('Login/user');
        }
    }
    
    public function reset_password_view()
    {
        echo view("templates/header");
        echo view("Login/reset_password_view");
    }

    public function change_pwd($uid,$token=""){
        $result = $this->resetToken->removeToken($uid,$token);
        // print_r($result);
        if($result){
            $data["role"] = '0';
            echo view('templates/header');
            echo view('Login/change_pwd', ["uid"=>$uid]);
        }
        else{
            $data["message"] = "Invalid Token or the token has expired";
            echo view('errors/html/error_404',$data);
        }
        
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
                    $uid = $userdata['UID'];
                    $to = $EMAIL;
                    $subject = 'Reset Password Link';
                    $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 50);
                    $result = $this->resetToken->saveToken($token,$uid);
                    if($result){
                        $message = 'Hi '.$userdata['FIRST_NAME'].' '.$userdata['LAST_NAME'].'<br><br>'
                            . 'Your reset password request has been  received. Please click'
                            . 'the below link to reset your password.<br><br>'
                            . '<a href="'.base_url('FAH/UserHome/change_pwd').'/'.$uid.'/'.$token.'">Click here to reset password</a><br><br>'
                            . 'Thanks<br>Floored At Home';
                        $EMAIL = \Config\Services::email();
                        $EMAIL->setTo($to);
                        $EMAIL->setFrom('vaghasia84@gmail.com','Floored At Home');
                        $EMAIL->setSubject($subject);
                        $EMAIL->setMessage($message);
                        if($EMAIL->send())
                        {
                            session()->setTempdata('success','Reset password link sent to registered email.',3);
                            return redirect()->to(base_url('FAH/UserHome/reset_password_view'));
                        }
                        else{
                            session()->setTempdata('error','Reset password link was not sent to registered email.',3);
                            return redirect()->to(base_url('FAH/UserHome/reset_password_view'));
                        }
                    }
                    else{
                        session()->setTempdata('error','Reset password link already sent.',3);
                        return redirect()->to(base_url('FAH/UserHome/reset_password_view'));
                    }
            }
            else
            {
                $this->session->setTempdata('error','Unable to update. Please try again',3);
                return redirect()->to(base_url('FAH/UserHome/reset_password_view'));
            }
        }
        else
        {
            $this->session->setTempdata('error','Sorry! Email does not exists',3);
            return redirect()->to(base_url('FAH/UserHome/reset_password_view'));
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('FAH')); 
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
                        $role = $userdata['RID'];
                        $newdata = [
                            'email'  =>  $EMAIL,
                            'logged_in_time' => $log_time,
                            'roleid' => $role,
                        ];
                        
                        $this->session->set($newdata);
                        $EMAIL = $this->session->get('email');
                        $userdata = $this->loginModel->verifyEmail($EMAIL);
                        $data['email'] = $this->session->get('email');
                        $data['logged_in_time']= $this->session->get('logged_in_time');
                        $email=$data['email'];
                        $UID = $userdata['UID'];
                        $logged_in_time=$data['logged_in_time'];
                        $result = $this->timingModel->timeclick($UID,$email,$logged_in_time,$clicked='login');

                        if($userdata['RID'] == '3')
                            return redirect()->to(base_url('FAH/UserHome/user_home'));
                        else if($userdata['RID'] == '2')
                            return redirect()->to(base_url('FAH/UserHome/vendor_home'));
                        else if($userdata['RID'] == '1')
                            return redirect()->to(base_url('FAH/Admin/index'));
                     
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

    public function getFileDate($module,$rec_id,$token,$attachment_id,$name)
    {
        $headers = array('Authorization: Zoho-oauthtoken '.$token);
        $ch = curl_init('https://www.zohoapis.com/crm/v2.1/'.$module.'/'.$rec_id.'/actions/download_fields_attachment?fields_attachment_id='.$attachment_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// Turn off the server and peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//Set to return data to string ($response)
        $response = curl_exec($ch);
        file_put_contents($_SERVER["DOCUMENT_ROOT"].'/FAH/public/assets/files/'.$name, $response);
        return '/FAH/public/assets/files/'.$name;
       // /crm/org198050252/specific/ViewAttachment?fileId=7ujr9f54ab4665d524ae1bad1b4c59ddb7d66&module=PriceBooks&parentId=1850122000064600066&creatorId=1850122000016822350&id=1850122000081354033&name=JJA+Hardwood+W9.jpeg&downLoadMode=default
    }
    public function getClickuptask($task_id)
    {
        $headers = array('Authorization: pk_10857547_17TA4CH41Y5J9TZA1AJ1O78JBFSEXIGJ');
    	$ch = curl_init('https://api.clickup.com/api/v2/task/'. $task_id . "/?include_subtasks=true");
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_VERBOSE, 0);
    	$response = curl_exec($ch);
    	error_log("Tasks get from clickup  : ". json_encode($response));
    	$task_data = json_decode($response,true);
        return $task_data;
    }
    public function user_home()
    {
        if($this->session->get('roleid')=='3'){
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $data['email'] = $this->session->get('email');
            $data['logged_in_time']= $this->session->get('logged_in_time');
            $data['role'] = $this->session->get("roleid");
            $email=$data['email'];
            $UID = $userdata['UID'];


            $projectdata = $this->projectModel->projectDetails($UID);
            $ZC_PO_ID = $projectdata['ZC_PO_ID'];
            $pid = $userdata['PID'];
            $model = new CommentModel();
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
            if(isset($mp_images) && !empty($mp_images) && count($mp_images) > 0 )
            {
                if(strlen($mp_images["data"][0]["Image_URL"])>0)
                {
                    $mp_image_url = $mp_images["data"][0]["Image_URL"];
                }
            }
            else
            {
                $mp_image_url = base_url('/public/assets/images/No_Image_Available.jpg');
            }
            $email = $po_data["Owner"]["email"];
			$mname = $po_data["Owner"]["name"];

            echo view("templates/header");
            echo view("templates/navbar",["data" => $data,"email"=>$email,"name"=>$mname]);
            echo view("home/user_home", ["pid"=>$pid, "comments"=>$comments,"po_data"=>$po_data,"mp_image_url"=>$mp_image_url,"email"=>$email,"name"=>$mname,"urls"=>$url]);
        }     
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }

    public function poropose_new_price()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $proposed_price = $this->request->getPost('proposed_price');
                $rec_id = $this->request->getPost('rec_id');
                $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
                $price_update_data = [];
                $price_update_data["Proposed_Price"] = $proposed_price;
                $price_update_data["Status"] = "Proposed";
                $price_update_data_final = [];
                $price_update_data_final["data"] = array($price_update_data);
                $price_update_data_final["trigger"] = array("workflow");
                $price_update_data_final = json_encode($price_update_data_final);
                $headers = array('Authorization: Zoho-oauthtoken '.$token);
                $ch = curl_init('https://www.zohoapis.com/crm/v2/Products_X_Teams/'.$rec_id);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $price_update_data_final);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                $response = curl_exec($ch);
                curl_close($ch);
                
                $json_for_update_response = json_decode($response, true);
                if($json_for_update_response['data'][0]['status'] == "success")
                {
                    $this->session->setTempdata('successvendhome','Proposed successfully!',3);
                    return redirect()->to(base_url('FAH/UserHome/vendor_home'));
                }
                else
                {
                    $this->session->setTempdata('errorvendhome','Sorry! Something Went Wrong While Proposing New Price  : '.$json_for_update_response['data'][0]["message"] ,3);
                    return redirect()->to(base_url('FAH/UserHome/vendor_home')); 
                }
            
            }
            else
            {
                return redirect()->to(base_url('FAH'));
            }

        }   
        else
        {
            return redirect()->to(base_url('FAH'));
        }
    }
    
    public function projectView($id)
    {
        if($this->session->get('email')!='')
        {
            $task_data =  $this->getClickuptask($id);
            $data["role"] = $this->session->get("roleid");
            $cus_fields = $task_data["custom_fields"];
            $proj_data =  [];

            $proj_data["name"] = $task_data["name"];
            foreach ($cus_fields as $cus_field)
            {
                if($cus_field["name"] === "ZC PO ID")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $ZC_PO_ID = $cus_field["value"];
                    }
                }
                if($cus_field["name"] === "Street")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Street"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Street"] = "";
                    }
                }
                if($cus_field["name"] === "City")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["City"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["City"] = "";
                    }
                }
                if($cus_field["name"] === "Unit")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Unit"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Unit"] = "";
                    }
                }
                if($cus_field["name"] === "State")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["State"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["State"] = "";
                    }
                }
                if($cus_field["name"] === "Zip Code")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Zip Code"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Zip Code"] = "";
                    }
                }
                if($cus_field["name"] === "Email")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Email"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Email"] = "";
                    }
                }
                if($cus_field["name"] === "Phone")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Phone"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Phone"] = "";
                    }
                }
                if($cus_field["name"] === "Job Ticket Url")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Job Ticket Url"] = $cus_field["value"];
                    }
                    else
                    {
                        $proj_data["Job Ticket Url"] = "";
                    }
                }
                if($cus_field["name"] === "Vendor Invoice Url")
                {
                    if(isset($cus_field["value"]) && !empty($cus_field["value"]))
                    {
                        $proj_data["Vendor Invoice Url"] = $cus_field["value"];
                        // print_r($task_data["custom_fields"]);
                    }
                    else
                    {
                        $proj_data["Vendor Invoice Url"] = "";
                    }
                }
                
            }
            if(isset($ZC_PO_ID) && !empty($ZC_PO_ID))
            {
                echo view("templates/header", ["data" => $data]);
                echo view("templates/navbar");
                echo view("home/project_home", ["ZC_PO_ID"=>$ZC_PO_ID, "task_data"=>$task_data,"proj_data"=>$proj_data]);
                // print_r($task_data["custom_fields"]);
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/UserHome/vendor_home'));
            }
        }  
        else{
            return redirect()->to(base_url('FAH'));
        } 
    }

    public function upload_doc()
    {
        if($this->session->has("email"))
        {
            if($this->request->getMethod() == 'post')
            {
                $v_id = $this->request->getPost('v_id');
                $field = $this->request->getPost('field');
                $field_api_name = str_replace(' ', '_', $field);
                $uploaded_file = $this->request->getPost('uploaded_file');

                $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
                $vendor_data = $this->getRecordById("Price_Books",$v_id,$token);

                if(isset($vendor_data[$field_api_name]) && !empty($vendor_data[$field_api_name]))
                {
                    $file_data = $vendor_data[$field_api_name][0];
                    $attachment_id = $file_data["attachment_Id"];

                    $filelist = [];
                    $file_data["attachment_id"]= $attachment_id;
                    $file_data["_delete"]= null;
                    array_push($filelist,$file_data);
                    $ven_update_data = [];
                    $ven_update_data[$field_api_name] = $filelist;
                    $ven_update_data_final = [];
                    $ven_update_data_final["data"] = array($ven_update_data);
                    $ven_update_data_final = json_encode($ven_update_data_final);
                    $headers = array('Authorization: Zoho-oauthtoken '.$token);
                    $ch = curl_init('https://www.zohoapis.com/crm/v2/Price_Books/'.$v_id);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $ven_update_data_final);
                    curl_setopt($ch, CURLOPT_VERBOSE, 1);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response = json_decode($response, true);
                    if($response['data'][0]['status'] != "success")
                    {
                        $this->session->setTempdata('errorvendhome','Sorry! Something Went Wrong While Removing Existing File.',3);
                        return redirect()->to(base_url('FAH/UserHome/vendor_home')); 
                    }
                   
                }

                $cfile = new \CURLFILE($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['type'], $_FILES['uploaded_file']['name']);
                $data = array();
                $data['file'] = $cfile;

                $headers = array('Authorization: Zoho-oauthtoken '.$token);
                $ch = curl_init('https://www.zohoapis.com/crm/v2/files');
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($ch);
                curl_close($ch);
            
                $json_for_cre_response = json_decode($response, true);

                if($json_for_cre_response['data'][0]['code'] == "SUCCESS")
                {
                    $crm_response_details =  $json_for_cre_response['data'][0]['details'];
                    $file_id = $crm_response_details["id"];

                    $filelist = [];
                    $file_data["file_id"]= $file_id;
                    array_push($filelist,$file_data);
                    $ven_update_data = [];
                    $ven_update_data[$field_api_name] = $filelist;
                    $ven_update_data[$field_api_name."_Status"] = "Uploaded";
                //    $ven_update_data[$field_api_name."_Exp_Date"] = "";
                    $ven_update_data_final = [];
                    $ven_update_data_final["data"] = array($ven_update_data);
                    $ven_update_data_final["trigger"] = array("workflow");
                    $ven_update_data_final = json_encode($ven_update_data_final);
                    $headers = array('Authorization: Zoho-oauthtoken '.$token);
                    $ch = curl_init('https://www.zohoapis.com/crm/v2/Price_Books/'.$v_id);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $ven_update_data_final);
                    curl_setopt($ch, CURLOPT_VERBOSE, 1);
                    $response = curl_exec($ch);
                    curl_close($ch);
                
                    $json_for_update_response = json_decode($response, true);
                    if($json_for_update_response['data'][0]['status'] == "success")
                    {
                        $this->session->setTempdata('successvendhome','Uploaded successfully!',3);
                        return redirect()->to(base_url('FAH/UserHome/vendor_home'));
                    }
                    else
                    {
                        $this->session->setTempdata('errorvendhome','Sorry! Something Went Wrong While Updating  : '.$json_for_update_response['data'][0]["message"] ,3);
                        return redirect()->to(base_url('FAH/UserHome/vendor_home')); 
                    }
                }
                else
                {
                    $this->session->setTempdata('errorvendhome','Sorry! Something Went Wrong While Uploading New File To ZFS : '.$json_for_cre_response['data'][0]["message"] ,3);
                    return redirect()->to(base_url('FAH/UserHome/vendor_home')); 
                }    
            }
            else
            {
                $this->session->setTempdata('errorvend','Sorry! Try again after some time.',3);
                return redirect()->to(base_url('FAH/UserHome/vendor_home'));
            }
        }
        else
        {
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
			
			var_dump($resp);
            if ($resp != NULL) 
            {
                foreach ($resp as $row) 
                {
                   // $date = mysql_to_php_date($row->comment_date);
                    echo "<li id=\"li_comment_{$row->comment_id}\">" .
                    "<div><span class=\"commenter\">{$commenter}</span></div>".
                    "<div><span class=\"comment_date\">{$row->comment_date}</span></div>" .
                    "<div style=\"margin-top:4px;\">{$row->comment_text}</div>" .
                    "<a href=\"#\" class=\"reply_button\" id=\"{$row->comment_id}\">reply</a>" .
                    "</li>";
                }
            } else {
                echo 'Error in adding comment';
            }
        } else {
            echo 'Error: Please enter your comment';
        }
    }
    public function vendor_home()
    {
        if($this->session->get("roleid")== "2"){
            $EMAIL = $this->session->get('email');
            $userdata = $this->loginModel->verifyEmail($EMAIL);
            $data["role"] = $this->session->get('roleid');
            $data["page"] = "";
            $data['email'] = $this->session->get('email');
            $data['logged_in_time']= $this->session->get('logged_in_time');
            $email=$data['email'];
            $UID = $userdata['UID'];
            $vendordata = $this->vendorModel->getvendorDetails($UID);
            $ZC_V_ID = $vendordata['ZC_V_ID'];
           
            $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
            $vendor_data = $this->getRecordById("Price_Books",$ZC_V_ID,$token);

            $fld_name_vs_api = array();
            $fld_name_vs_api["Workers Comp Insurance Paperwork"] = "Workers_Comp_Insurance_Paperwork";
            $fld_name_vs_api["Workers Comp Insurance Paperwork Exp. Date"] = "Workers_Comp_Insurance_Paperwork_Exp_Date";
            $fld_name_vs_api["Workers Comp Insurance Paperwork Status"] = "Workers_Comp_Insurance_Paperwork_Status";

            $fld_name_vs_api["W9 Tax Documentation"] = "W9_Tax_Documentation";
            $fld_name_vs_api["W9 Tax Documentation Exp. Date"] = "W9_Tax_Documentation_Exp_Date";
            $fld_name_vs_api["W9 Tax Documentation Status"] = "W9_Tax_Documentation_Status";


            $fld_name_vs_api["General Business Owner Liability"] = "General_Business_Owner_Liability";
            $fld_name_vs_api["General Business Owner Liability Exp. Date"] = "General_Business_Owner_Liability_Exp_Date";
            $fld_name_vs_api["General Business Owner Liability Status"] = "General_Business_Owner_Liability_Status";

            $fld_name_vs_api["Copy of Local License"] = "Copy_of_Local_License";
            $fld_name_vs_api["Copy of Local License Exp. Date"] = "Copy_of_Local_License_Exp_Date";
            $fld_name_vs_api["Copy of Local License Status"] = "Copy_of_Local_License_Status";

            $paper_work_data = array();
            foreach ($fld_name_vs_api as $key => $value)
            {

                if(isset($vendor_data[$value]) && !empty($vendor_data[$value])) 
                {

                        if(str_contains($key, "Exp. Date") || str_contains($key, "Status") )
                        {
                            $paper_work_data [$key]  = $vendor_data[$value];
                        }
                        else
                        {
                             $file_data = $vendor_data[$value][0];
                             
                             $attachment_id = $file_data["attachment_Id"];
                             $token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
                             $act_file = $this->getFileDate("Price_Books",$ZC_V_ID,$token,$attachment_id, $file_data["file_Name"]);
                             $paper_work_data [$key]  = $act_file;
                        }
                }
                else
                {
                    $paper_work_data [$key]  = "";

                }
            }
            
             if(isset($vendor_data["Clickup_Mapping_ID"]) && !empty($vendor_data["Clickup_Mapping_ID"]))
             {              
                $query_para = '[{"field_id":"14701564-c9c2-4386-9a10-5e40896e4722","operator":"ANY","value":["'.$vendor_data["Clickup_Mapping_ID"].'"]}]';
                $headers = array('Authorization: pk_10857547_17TA4CH41Y5J9TZA1AJ1O78JBFSEXIGJ');
                $ch = curl_init('https://api.clickup.com/api/v2/team/10525203/task?custom_fields%5B%5D='.urlencode($query_para));
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                $response = curl_exec($ch);
                curl_close($ch);    
                $response = json_decode($response,true);
                $ven_projs =  $response["tasks"];
             }   
             else
             {
                 $ven_projs = [];
             }    
            $products = $this->searchRecords("Products_X_Teams","(Teams:equals:".$ZC_V_ID.")",$token);
            $products = $products['data'];
            echo view("templates/header");
            echo view("templates/navbar",["data"=>$data]);
            echo view("home/vendor_home", ["zc_v_id"=>$ZC_V_ID, "vendor_data"=>$vendor_data,"paper_work_data"=>$paper_work_data,"ven_projs"=>$ven_projs,"products"=>$products ,"email"=>$email]);
        }
        else{
            return redirect()->to(base_url("FAH"));
        }  
    }
}
?>
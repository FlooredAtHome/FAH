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


    public function projectView($id)
    {
        if($this->session->get('email')!='')
        {
            $task_data =  $this->getClickuptask($id);
            $data["role"] = "2";
            $data["page"] = "vendorView";
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
                echo view("templates/navbar", ["data" => $data]);
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
    public function vendorView(){
        $data["role"] = $this->session->get("roleid"); 
        $data["page"] = "vendorView";
        $UID = intval($_GET['id']);
        $vendor = $this->vendorModel->getUserData($UID);
        $email = $vendor["EMAIL"];
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

    // public function vendorView()
    // {
    //     if($this->session->has("email"))
    //     {

    //         $EMAIL = $this->session->get('email');
    //         $userdata = $this->loginModel->verifyEmail($EMAIL);
    //         $UID = intval($_GET['id']);
    //         $details = $this->loginModel->getDetails($UID);
    //         $pid = $details['PID'];
	// 		$projectdata = $this->projectModel->projectDetails($UID);
    //         $ZC_PO_ID = $projectdata['ZC_PO_ID'];
    //         $model = new CommentModel();
    //         $logs = $this->timingModel->displayall($UID);
    //         $comments = $model->get_comments($pid);
	// 		$token = file_get_contents("https://fahbacksym.com/FAH/get_token.php?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9");
    //         $po_data = $this->getRecordById("Deals",$ZC_PO_ID,$token);
    //         $mp_images = $this->searchRecords("Magicplan_Images","((Potential:equals:".$ZC_PO_ID.")and(Type:equals:Outside Picture))",$token) ;
    //         $proposals = $this->searchRecords("Quotes","(Deal_Name:equals:".$ZC_PO_ID.")",$token);
    //         $proposal = [];
    //         $url = [];
    //         foreach($proposals['data'] as $proposal)
    //         {
    //             if($proposal['Ready_To_Send']!=NULL)
    //             {
    //                 $url[$proposal['id']] = $proposal['PandaDoc_PDF'];
    //             }
    //         }
	// 		if(count($mp_images) > 0 )
    //         {
    //             if(strlen($mp_images["data"][0]["Image_URL"])>0)
    //             {
    //                 $mp_image_url = $mp_images["data"][0]["Image_URL"];
    //             }
	// 			else
    //         	{
    //             	$mp_image_url = base_url('public/assets/images/No_Image_Available.jpg');
    //         	}
    //         }
	// 		$email = $po_data["Owner"]["email"];
	// 		$mname = $po_data["Owner"]["name"];
    //         echo view('Admin/customerView',["pid"=>$pid,"comments"=>$comments,"LOGS"=>$logs,"po_data"=>$po_data,"mp_image_url"=>$mp_image_url,"email"=>$email,"name"=>$mname,"urls"=>$url]);
    //     }
    //     else
    //     {
    //         return redirect()->to(base_url('/'));
    //     }
    // }
}

?>
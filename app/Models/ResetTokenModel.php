<?php

namespace App\Models;

use CodeIgniter\Model;

class ResetTokenModel extends Model
{
    protected $table = 'reset_token';
    protected $primaryKey = 'UID';
    protected $allowedField = ['UID','token'];
    public function removeToken($uid,$token)
    {
        $db = \Config\Database::connect();
        $data = [
            'UID' => $uid,
            'token'  => $token,
        ];
        $builder = $db->table("reset_token");
        $result = $builder->select("*")->where('token',$token)->get()->getResultArray();
        if(count($result) == 1){
            $currentTime = time();
            $expiryTime = strtotime($result[0]["expiry"]);
            if($currentTime < $expiryTime){
                    return true;
                }
                else{
                    $builder->delete($data);
                    return false;
                }
            }
        else{
            return false;
        }
    }
    public function saveToken($token,$UID){
        $db = \Config\Database::connect();
        $data = [
            'UID' => $UID,
            'token'  => $token,
            'expiry' => date('Y-m-d h:i:s',time()+ (60*60*0.5)), // currently set to 60 seconds of expiry time
        ];
        $builder = $db->table("reset_token");
        $result = $builder->select("UID")->where('UID',$UID)->get()->getResultArray();
        // var_dump($result);
        // exit;
        if(count($result) >= 1){
            return false;
        }
        else{
            $builder->insert($data);
            return true;
        }
        
    }

    public function customerUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE users SET FIRST_NAME='$FIRST_NAME', LAST_NAME='$LAST_NAME', EMAIL='$EMAIL' WHERE UID='$UID';";
        $result = $this->db->query($sql);
        if($result == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
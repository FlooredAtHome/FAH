<?php
namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    
    protected $table      = 'users';
    protected $primaryKey = 'UID';
    // protected $returnType = 'array';
    protected $allowedFields = ['RID','FIRST_NAME','LAST_NAME','EMAIL','PASSWORD'];

    public function verifyEmail($EMAIL)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.RID,u.UID,u.PASSWORD,u.FIRST_NAME,u.LAST_NAME,p.PID FROM users u LEFT JOIN projects p ON u.UID = p.UID WHERE u.EMAIL='$EMAIL';";
        $results = $this->db->query($sql);
        $results = $results->getRowArray();
        if($results === null)
        {
            return false;
        }
        else
        {
            return $results;
        }
    }
    public function getDetails($UID)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT u.RID,u.UID,u.PASSWORD,u.FIRST_NAME,u.LAST_NAME,p.PID FROM users u LEFT JOIN projects p ON u.UID = p.UID WHERE u.UID='$UID';";
        $results = $this->db->query($sql);
        $results = $results->getRowArray();
        if($results === null)
        {
            return false;
        }
        else
        {
            return $results;
        }
    }
    public function updatedAt($id)
    {
        $builder = $this->db->table('users');
        $builder->where('UID', $id);
        $builder->update(['PASS_UPDATE_TIME'=>date('Y-m-d h:i:s')]);    
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function pwd_change_verify($email,$uid){
        $db = \Config\Database::connect();
        $sql = $db->query("SELECT * FROM users WHERE EMAIL='$email' AND UID ='$uid';");
        $result=$sql->getRow();
        if(isset($result)){
            return true;
        }
        else{
            return false;
        }
    }

    public function updatepass($npass,$uid){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set('PASSWORD',$npass);
        $builder->where('UID',$uid);
        $result= $builder->update();
        if(isset($result)){
            return true;
        }
        else{
            return false;
        }
    }
    // public function insert($user){
    //     // $sql_check="SELECT * from users where FIRST_NAME = '$user['FIRST_NAME'] && $user[]'";
    //     sql="INSERT INTO users (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD) VALUE($user['FIRST_NAME'],$user['LAST_NAME'],$user['EMAIL'],$user['PASSWORD'])";
    //     if(mysqli_query($sql)){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
}

?>
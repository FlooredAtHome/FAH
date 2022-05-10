<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class APIModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'UID';
    protected $allowedFields = ['FIRST_NAME','LAST_NAME','RID','EMAIL'];

    public function insertId($role,$email,$zcid)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT UID FROM users WHERE EMAIL='$email';";
        $result = $this->db->query($sql);
        $result = $result->getRowArray();
        $uid = $result['UID'];
        if($role == 2){
            $insertSql = "INSERT INTO vendor (UID,ZC_V_ID) VALUES ('$uid',$zcid);";
            $response = $this->db->query($insertSql);
        }
        if($role ==3){
            $insertSql = "INSERT INTO customer (UID) VALUES ('$uid');";
            $response = $this->db->query($insertSql);
            $select = "SELECT CID FROM customer WHERE UID='$uid';";
            $output = $this->db->query($select)->getRowArray();
            $cid = $output['CID'];
            $insertQuery = "INSERT INTO projects (UID,ZC_PO_ID,CID) VALUES ('$uid','$zcid',$cid);";
            $status = $this->db->query($insertQuery);
        } 
    }

    public function viewUser($uid){
        $db = \Config\Database::connect();
        $builder = $db->table("users");
        if($uid=="all"){
            $result = $builder->select("*")->get()->getResultArray();
        }
        else{
            $result = $builder->select("*")->where('UID',$uid)->get()->getResultArray();
        }
        return $result;
    }

    public function getUserData($email){
        $db = \Config\Database::connect();
        $sql = "SELECT UID FROM users WHERE EMAIL='$email';";
        $result = $this->db->query($sql);
        $result = $result->getRowArray();
        return $result["UID"];
    }
}
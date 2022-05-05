<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorModel extends Model
{
    protected $table = 'users';
    protected $primeryKey = 'UID';
    protected $allowedField = ['FIRST_NAME','LAST_NAME','EMAIL','PASSWORD','RID'];
    public function vendorDetails($EMAIL)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users WHERE RID='2';";
        $customers = $this->db->query($sql);
        $customers = $customers->getResultArray();
        return $customers;
    }
    public function vendorUpdates($UID,$FIRST_NAME,$LAST_NAME,$EMAIL)
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
    public function insertVendor($FIRST_NAME,$LAST_NAME,$EMAIL,$RID)
    {
        $db = \Config\Database::connect();
        $sql = "INSERT INTO users (FIRST_NAME,LAST_NAME,EMAIL,RID) VALUES ('$FIRST_NAME','$LAST_NAME','$EMAIL','$RID');";
        $result = $this->db->query($sql);
        if($result == true)
        {
            $sqlselect = "SELECT UID FROM users WHERE EMAIL='$EMAIL';";
            $response = $this->db->query($sqlselect)->getRowArray();
            $uid = $response['UID'];
            $sqlinsert = "INSERT INTO vendor (UID) VALUES ('$uid');";
            $output = $this->db->query($sqlinsert);
            if($output == true)
            { 
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function getvendorDetails($UID)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM vendor WHERE UID=$UID;";
        $vendors = $this->db->query($sql);
        $vendors = $vendors->getRowArray();
        if($vendors === null)
        {
            return false;
        }
        else
        {
            return $vendors;
        }
    }
}

?>
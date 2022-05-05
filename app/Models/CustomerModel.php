<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'users';
    protected $primeryKey = 'UID';
    protected $allowedField = ['FIRST_NAME','LAST_NAME','EMAIL','PASSWORD'];
    public function customerDetails($EMAIL)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users WHERE RID='3';";
        $customers = $this->db->query($sql);
        $customers = $customers->getResultArray();
        return $customers;
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
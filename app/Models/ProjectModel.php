<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primeryKey = 'PID';
    protected $allowedField = ['UID','VID','CID','PID','ZC_PO_ID'];
    public function projectDetails($UID)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM projects WHERE UID=$UID;";
        $projects = $this->db->query($sql);
        $projects = $projects->getRowArray();
        if($projects === null)
        {
            return false;
        }
        else
        {
            return $projects;
        }
    }
}

?>
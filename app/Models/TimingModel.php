<?php

namespace App\Models;

use CodeIgniter\Model;

class TimingModel extends Model
{
    public function timeclick($uid,$EMAIL,$proptime,$clicked)
    {
        $db = \Config\Database::connect();
        $strtime = date('d F Y H:i:s',$proptime);
        if($clicked =='prop'){
            $builder = $db->table('proplogs');
            $data=['EMAIL'=> $EMAIL,'UID' => $uid,'PROPTIME' => $proptime,'STRINGTIME' => $strtime];
            $query2 = $builder->insert($data);
        }
        elseif($clicked =='inv'){
            $builder = $db->table('invlogs');
            $data=['EMAIL'=> $EMAIL,'UID' => $uid,'INVTIME' => $proptime, 'STRINGTIME' => $strtime];
            $query2 = $builder->insert($data);
        }
        elseif($clicked == 'login'){
            $builder = $db->table('loginlogs');
            $data=['EMAIL'=> $EMAIL,'UID' => $uid,'LOGINTIME' => $proptime, 'STRINGTIME' => $strtime];
            $query2 = $builder->insert($data);
        }
    }
    public function displayall($uid){
        $db = \Config\Database::connect();
        $builder1 = $db->table('proplogs');$query1 = $builder1->select('STRINGTIME')->where('UID',$uid)->orderBy('STRINGTIME', 'DESC')->getCompiledSelect(false);$temp1 = $builder1->get()->getResultArray();
        $builder2 = $db->table('invlogs');$query2 = $builder2->select('STRINGTIME')->where('UID',$uid)->orderBy('STRINGTIME', 'DESC')->getCompiledSelect(false);$temp2 = $builder2->get()->getResultArray();
        $builder3 = $db->table('loginlogs');$query2 = $builder3->select('STRINGTIME')->where('UID',$uid)->orderBy('STRINGTIME', 'DESC')->getCompiledSelect(false);$temp3 = $builder3->get()->getResultArray();
        $result = [$temp1,$temp2,$temp3];
        return $result;
    }
}

?>
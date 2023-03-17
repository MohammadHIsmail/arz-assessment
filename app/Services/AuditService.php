<?php

namespace App\Services;

use App\Models\AuditTrail;

class AuditService
{

    public static function AuditLog($prevData,$newData,$performedBy,$tableAudited,$operation){
        $dataChanged=false;
        $audit=new AuditTrail();
        $change='';
        if($operation!='edit'){
            $dataChanged=true;
        }else{
            foreach($prevData as $key => $data){
                if($data!=$newData[$key]){
                    $dataChanged=true;
                    $change=$change.$key.": ".$data." -> ".$newData[$key]."\r\n";
                }
            }
        }
        if($dataChanged){
            $audit->performed_by=$performedBy;
            $audit->changed_table=$tableAudited;
            $audit->changes=$change;
            $audit->operation=$operation;
            $audit->save();
        }

    }
}
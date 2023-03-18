<?php

namespace App\Services;

use App\Models\AuditTrail;

class AuditService
{

    public static function AuditLog($prevData,$newData,$performedBy,$tableAudited,$operation){
        $audit=new AuditTrail();
        $change='';
        if($operation=='add'){
            foreach($newData as $key => $data){
                $change=$change.$key.": ".$data."\r\n";
            }
        }else{
            foreach($prevData as $key => $data){
                if($data!=$newData[$key]){
                    $change=$change.$key.": ".$data." -> ".$newData[$key]."\r\n";
                }
            }
        }

        $audit->performed_by=$performedBy;
        $audit->changed_table=$tableAudited;
        $audit->changes=$change;
        $audit->operation=$operation;
        $audit->save();


    }
}
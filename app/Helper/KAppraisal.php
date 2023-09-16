<?php
namespace App\Helper;

class KAppraisal {

    public static function dateDay($addedAt, $lastCheckAt){
        $valueDiffdate = 0;
        $tgl1 = strtotime($addedAt); 
        $tgl2 = strtotime($lastCheckAt); 

        $jarak = $tgl2 - $tgl1;
        if ( $jarak < 0 ){
            return 0;
        }

        $valueDiffdate = $jarak / 60 / 60 / 24;
        return $valueDiffdate;
    }
}

?>
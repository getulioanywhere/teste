<?php

namespace App\Classes;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */

class Curl {

    public static function exec_curl($path, $buildQuery = null) {
        if ($_SERVER['HTTP_HOST'] == ('localhost' || '127.0.0.1')) {            
            $ssl = false;
        } else {            
            $ssl = true;
        } 

        $curl = curl_init($path);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $ssl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        if ($buildQuery !== null) {
            $buildQuery = http_build_query($buildQuery);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
            curl_setopt($curl, CURLOPT_POST, true);
        }

        $response = curl_exec($curl);
        curl_close($curl);       
        
        return $response;
    }    

}
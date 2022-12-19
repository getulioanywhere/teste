<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */

//classe para criar log personalisados
//variavel $file é o nome do arquivo e o nome do diretório 
class Logs {

    public static function log($fileLog, $info) {
        $file = !is_null(config('file_dir_logs.' . $fileLog)) ? config('file_dir_logs.' . $fileLog) : $fileLog;
        
        $header = Request::header();
        $datetime = date('Y-m-d H:i:s', time());
        if (is_array($info)) {
            array_push($info, $header);
            array_push($info, ['action' => $datetime]);
            $info = json_encode($info);
        } else {
            $info = $info . ' - Header: ' . json_encode($header) . ' - action: ' . $datetime;
        }
        
        $file = str_replace(' ', '_', $file);
        $file = trim($file);
        $file = strtolower($file);
        
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/' . $file . '/' . $file . '_' . date('Y-m-d') . '.log'),
        ])->info($info);
    }

}

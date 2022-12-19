<?php

namespace Modules\Lgpd\Http\Controllers;

use App\Classes\Process;
use Modules\Lgpd\Models\Lgpd;
use Modules\Lgpd\Models\PageLgpd;

class ApiLgpdController {

    public function index() {
        try {

            return response()->json([
                        'success' => true,
                        'data' => $this->select(),
                            ], 200);
        } catch (\Exception $ex) {
             return response()->json(['message' => $ex->getMessage(), 'status' => 'Error']);
        }
    }

    protected function select() {
        $company = new PageLgpd();
        return $company->first()->toArray();
    }
    
    public static function subscrible() {
        //envia dados para gravar arquivo em json no web-site-cliente
        $process = new Process();
        $api = new ApiLgpdController();
        $process->subscrible($api->select(), 'lgpd');
    }

    public function consents()
    {
        $lgpd = new Lgpd;
        
        try {
            \DB::transaction(function () use ($lgpd) {
                $lgpd->create(request()->all());
            });
        } catch (\Exception $ex) {
             return response()->json(['message' => $ex->getMessage(), 'status' => 'Error']);
        }
    }
}

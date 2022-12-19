<?php

namespace Modules\Company\Http\Controllers;

use App\Classes\Process;
use Illuminate\Support\Str;
use Modules\Company\Models\Company;

class ApiCompanyController {

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
        $company = new Company();
        $ret = $company->first()->toArray();

        $address = $this->same('address_*', $ret);
        $ret = collect($ret)->put('address', $address->all());

        if(!is_null($ret)){            
            return $ret->toArray();
        }
        return false;
    }

    function same($pattern, $array) {
        $data = collect();

        foreach ($array as $key => $item) {
            if(Str::is($pattern, $key)) $data->push($item);
        }
        
        return $data;
    }
    
     public static function subscrible() {
        //envia dados para gravar arquivo em json no web-site-cliente
        $process = new Process();
        $api = new ApiCompanyController();
        $ret = $api->select();
        if($ret){            
            $process->subscrible($api->select(), 'company');
        }
    }

}

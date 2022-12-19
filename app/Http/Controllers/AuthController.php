<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Classes\Logs;

use Modules\Company\Models\Company;

class AuthController extends Controller {

    public function index() {
        if (Auth::check() === false) {            
            return view('login.login');
        } else {
            return redirect()->intended(route('dashboard'));
        }
    }

    public function login() {
        $credentials = request()->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        $auth = Auth::attempt([
                    'email' => $credentials['email'],
                    'password' => $credentials['password'],
                    'active' => 1
        ]);
        if ($auth) {
            $this->controlLog('access', Auth::user());
            request()->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        } else {
            $this->controlLog('attempts', $credentials);

            return back()->withErrors([
                        'email' => 'Verifique email ou a senha.',
                    ])->withInput(request()->all());
        }
    }

    public function logout() {
        $this->controlLog('logout', Auth::user() . ' - logout ');
        Auth::logout();
        return redirect('login');
    }

    protected function controlLog($filedir, $message) {
        /*
         * Nome dos arquivos e diretórios para Log, encontra se em:
         * admin\config\file_dir_logs.php
         * 
         * Para cada envento será gravado o Log. Acessos, Logout e tentativas
         */
        
        if (env('STOP_LOGS') !== false) {
            //return Logs::log($filedir, $message);
        }else{
            return false;
        }
    }

}

<?php
namespace Modules\Lgpd\Http\Controllers;
use Modules\Lgpd\Models\PageLgpd;
use App\Classes\Process;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Classes\Functions;
use App\Classes\DataReturn;

use Modules\Lgpd\Http\Controllers\ApiLgpdController;

class LgpdPageController extends Controller {

    protected $module = 'lgpd'; //nome do módulo
    protected $model;
    protected $process;
    protected $functions;

    public function __construct() {
        $this->model = new PageLgpd();
        $this->process = new Process($this->model, $this->module);
        $this->functions = new Functions();
    }    
    public function show(Request $request, $id = null) {
        //Mostra os dados conforem ID selecionado na listagem 
        $process = $this->process->show($request, $id);
        $process = $this->functions->removeButtonCreate($process);  
        
        ApiLgpdController::subscrible();
        
        return view($process[0], $process[1]);
    }
    public function update(Request $request, $id) {
        //atualizar os dados por ajax/fetch 
        return $this->process->update($request, $id);
    }
}
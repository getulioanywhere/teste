<?php

namespace Modules\Company\Http\Controllers;


use App\Classes\Functions;
use App\Classes\Process;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
//use Illuminate\Support\Facades\Crypt;
use Modules\Company\Models\Company;
use Modules\Company\Http\Controllers\ApiCompanyController;

class CompanyController extends Controller {

    //removido o indice routeCreate e botão delete, 
    //pois empresa existe somente uma nesse momento
    protected $module = 'company'; //nome do módulo
    protected $model;
    protected $process;
    protected $functions;
    protected $curl;
    protected $path;

    public function __construct() {
        $this->model = new Company(); //instância da Model para variavel $model
        $this->process = new Process($this->model, $this->module);
        $this->functions = new Functions();
    }

    public function index() {
        //Listagem em tabela 
        $process = $this->process->index();

        $process = $this->functions->removeButtonCreate($process);
        $process = $this->functions->removeButtonDelete($process);

        ApiCompanyController::subscrible();
        
        return view($process[0], $process[1]);
    }

    public function show(Request $request, $id = null) {
        //Mostra os dados conforem ID selecionado na listagem 
        $process = $this->process->show($request, $id);
        $process = $this->functions->removeButtonCreate($process);
        $this->process->subscrible($process[1]['data'], 'company');
        return view($process[0], $process[1]);
    }

    public function update(Request $request, $id) {
        //atualizar os dados por ajax/fetch         
        return $this->process->update($request, $id);
    }

}

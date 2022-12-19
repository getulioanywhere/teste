<?php

namespace Modules\User\Http\Controllers;

use App\Classes\DataReturn;
use App\Classes\Functions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Classes\Process;

class UserController extends Controller {

    protected $module = 'user'; //nome do módulo
    protected $model;
    protected $process;
    protected $functions;

    public function __construct() {
        $this->model = new User(); //instância da Model para variavel $model
        $this->process = new Process($this->model, $this->module);
        $this->functions = new Functions();
    }

    public function index() {
        /* Listagem em tabela */
        $process = $this->process->index(); 
        return view($process[0], $process[1]);
    }

    public function create(Request $request) {
        return $this->process->create($request);
    }

    public function show(Request $request, $id = null) {
        //Mostra os dados conforem ID selecionado na listagem
        $process = $this->process->show($request, $id)  ;               
        return view($process[0], $process[1]);
    }

   public function update(Request $request, $id) {
        //atualizar os dados por ajax/fetch 
        return $this->process->update($request, $id);
    }

    public function destroy(Request $request, $id) {
        return $this->process->destroy($request, $id);
    }

}

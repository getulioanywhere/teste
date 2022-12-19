<?php

namespace App\Classes;

use App\Classes\DataTables;
use App\Classes\DataReturn;
use App\Classes\Functions;
use App\Classes\Curl;
use Modules\Company\Models\Company;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */
class Process {

    protected $module;
    protected $model;
    protected $id;
    protected $function;
    protected $tables;

    public function __construct($model = null, $module = null, $id = null) {
        $this->id = !is_null($id) ? $id : null;
        $this->model = $model;
        $this->module = $module;
        $this->tables = new DataTables();
        $this->function = new Functions();
    }

    public function process() {
        //return eval('$this->' . $this->function . '();');
    }

    public function index(array $options = []) {
        // Listagem em tabela        
        $index = array_key_exists('view', $options) ? $options['view'] : 'index'; //opção de view
        $selectTable = array_key_exists('select-table', $options) ? $options['select-table'] : 'select-table'; //utiliza está config para montar tabela
        $config = array_key_exists('config', $options) ? $options['config'] : ''; //opção de config quando possui mais de uma

        try {
            $view = $this->module . '::' . $index; //monta a variavel de view
            $data = DataReturn::returnDataTable($this->model, $this->module, $selectTable, $config); //executa a montagem dos dados            
            $array = [$view, $data]; //monta array com view e os dados no data
            return $array; //retorna array com os valores acima
        } catch (Exception $ex) {
            return $ex; //caso haja erros retorna o exception
        }
    }

    public function create($request) {
        try {
            $message = DataReturn::returnDataCreatajax($this->model, $request, $this->module);
        } catch (Exception $ex) {
            $message = $ex;
        }
        return response()->json(['return' => $message]);
    }

    public function show($request, $id = null, array $options = []) {
        // Mostra os dados conforem ID selecionado na listagem        
        try {
            $index = array_key_exists('view', $options) ? $options['view'] : 'show'; //opção de view
            $config = array_key_exists('config', $options) ? $options['config'] : ''; //opção de config
            $view = $this->module . '::' . $index; //monta variavel para view
            $data = DataReturn::returnDataShow($this->model, $request, $this->module, $id, $config);
            $array = [$view, $data]; //array com view e data            
            return $array; //retorna o array acima
        } catch (Exception $ex) {
            return $ex; //caso tenha erro retorna exception
        }
    }

    public function update($request, $id, $tables = null) {
        //atualizar os dados por ajax/fetch
        try {
            $message = DataReturn::returnDataUpdateajax($this->model, $request, $id, $this->module, $tables);
        } catch (Exception $ex) {
            $message = $ex;
        }
        return response()->json(['return' => $message]);
    }

    public function destroy($request, $id) {
        try {
            $message = DataReturn::returnDataDestroyajax($this->model, $request, $id);
        } catch (Exception $ex) {
            $message = $ex;
        }
        return response()->json(['return' => $message]);
    }

    public function subscrible($data, $filename) {
        $curl = new Curl();
        $company = new Company();
        $website = $company->select('http_website')->first()->toArray();
        $link = reset($website);
        if (substr($link, -1) === '/') {
            $link = substr($link, 0, -1);
        }
        $path = $link . "/api/data";
        $val = [
            'data' => $data,
            'file' => $filename
        ];
        return $curl->exec_curl($path, $val);
    }

    public function indexAjax($options = []) {
        //DataTables        
        $request = request()->input();
        if (array_key_exists('config', $options)) {
            $configA = '.' . $options['config'];
        } else {
            $configA = '';
        }
        $columns = preg_replace('/[\s\n\r\t]/', '', config($this->module . $configA . '.data-tables'));
        $request['columns'] = $columns;

        if (array_key_exists('show', $options)) {
            $request['route_show'] = $this->module . $configA . '.routes.show.name';
        }

        if (array_key_exists('delete', $options)) {
            $request['route_delete'] = $this->module . $configA . '.routes.destroy.name';
        }

        if (array_key_exists('table', $options)) {
            $request['table'] = $options['table'];
        }

        if (array_key_exists('connection', $options)) {
            $request['connection'] = $options['connection'];
        }

        if (array_key_exists('where', $options)) {
            $request['where'] = $options['where'];
        }

        return $this->tables->mount_data_tables($request, $this->model);
    }

    public function selectTableAll($model, $process) {        
        $process[1][$model->getTable()] = json_decode($model->all()->toJson());
        return $process;
    }

}

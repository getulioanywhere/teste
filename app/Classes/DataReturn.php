<?php

namespace App\Classes;

use App\Classes\Functions;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */
class DataReturn {

    protected $edit = 'Editar';
    protected $destroy = 'Deletar';
    protected $dir = '../storage/consultas/';
    protected $function;
    protected $datareturn;

    /* CREATE */

    public static function returnDataCreatajax($model, $request, $module) {
        try {
            $DataReturn = new DataReturn();
            $data = Functions::decryptDataIndex($request, $module);

            $query = $model->create($data);
            $ret = $query->save();

            $DataReturn->createLog(__FUNCTION__, $query, $request, $data, $ret);
            return $DataReturn->returnMessage($ret);
        } catch (Exception $ex) {
            //Logs::log('error_' . __FUNCTION__, $ex);
            return $ex;
        }
    }

    /* UPDATE */

    public static function returnDataUpdateajax($model, $request, $id, $module, $tables = null) {

        $DataReturn = new DataReturn();
        $function = new Functions();

        if (!is_null($tables)) {

            //se exitir o array de tabelas para filtrar os relacionamentos.
            //Caso não existe passa para proxima instrução
            //$tablesRela = $function->separatorTable($tables, $request);
            //primeiro precisa da tabela principal. Ex: produtos
            //depois Id
            $ret = []; //para testes - armazena algumas etapas para saida com informações da função
            $idPk = $function->descrypt($id); //id do produto ou item
            $arraytables = [$model->getTable()]; //cria array com o nome da tabela principal que possui relacionamentos
            $relaTables = $function->showTablesAll($model, $id); //chama todoas a tabelas relacionadas com a principal

            foreach ($relaTables as $key => $value) {
                array_push($arraytables, $key); //cria uma lista com os nomes das tabelas relacionadas
            }
            //separa com os valores recebidos de request
            $tablesRela = $function->separatorTable($arraytables, $request);

            //armazena somente os valores da tabela principal de acordo com a request.
            $data = $tablesRela[$model->getTable()];

            //executa update soemtne da tabela principal
            $modelTable = $DataReturn->find($model, $id);
            $modelTable->update($data);
            $modelTable->find($idPk);

            //abaiaxo será executada para as tabelas relacionadas uma a uma de acordo com os nomes das funções 
            //criadas na camada de modelo da tabela principal.
            foreach ($tablesRela as $tab => $val) {
                if ($tab !== $model->getTable()) {
dd($tablesRela, $tab, $val, $arraytables);
                    $ret[__LINE__ . ' - ' . $tab] = 'ENTROU NO FOREACH';
                    //separa os dados da tabela e request da tabela principal
                    //executa somente as tabelas relacionadas.
                    //verifica se exite a função de acordo com o nome da tabela relacionada.
                    //seguir exemplo do produto admin\catalog\Products\Models\Product.php
                    if (method_exists($model, $tab) === true) {
                        $ret[__LINE__ . ' - ' . $tab] = 'VERIFICA O MÉTODO - ' . method_exists($model, $tab);

                        //abaixo confirma se exite valores de request de acorodo com o nome da tabela.
                        //se não existir ele não executa e passa para a próxima
                        if (!empty($tablesRela[$tab])) {
                            $ret[__LINE__ . ' - ' . $tab] = 'VERIFICA O ARRAY É VAZIO - ' . empty($tablesRela[$tab]);

                            //dd($tablesRela, $tablesRela[$tab]);

                            $idpk = reset($tablesRela[$tab]); //pega o primeiro item do array e verifica se é id                            
                            $ret[__LINE__ . ' - ' . $tab] = 'PEGA PRIMEIRO ITEM E CONFIRMA SE E ID - ';

                            $method = $modelTable->{$tab}(); //aramazena o nome do metodo de relacionamento
                            $ret[__LINE__ . ' - ' . $tab] = 'PASSA O MÉTODO PARA A VARIAVEL - ' . $method;

                            //valida se é um id ou não, se apenas uma string.
                            //essa função é para verificar se são textos ou checkbox que possuem id
                            if (!is_string($idpk) && strpos(get_class($method), 'HasOne') === false) {
                                //aqui executa somente se for metodo com uso não hasOne e somente belongsToMany
                                //usado para relacionamento de muitos para muitos, usado com checkbox
                                $ret[__LINE__ . ' - ' . $tab] = 'VERIFICA SE NÃO É HASONE - ';

                                $result = $method->sync($idpk);

                                $ret[__LINE__ . ' - ' . $tab] = 'EXECUTA SYNC - ' . $result;
                            } else {
                                //aqui executa somente se for metodo com uso de 
                                //hasOne
                                //usado para relacionamento de um para muitos, usado para imegsn, blocks por exemplo
                                //if ($tab === 'product_blocks') {

                                if (is_array($val)) {
                                    if (is_string(key($val))) {
                                        $val = reset($val); //organiza os valores do array
                                    }
                                    if (is_array($val) && is_int(key($val))) {
                                        //verifica se os indices são int, isso confirma que será update.
                                        foreach ($val as $key => $value) {
                                            //percorre os valores dos indices int
                                            if (array_key_exists('id', $value)) {
                                                //se exitir id, reserva o valor
                                                $idPkReal = $function->descrypt(reset($value));
                                                if (is_int($idPkReal)) {
                                                    //confirma que id possui valor int e executa update
                                                    DB::table($tab)
                                                            ->where(key($value), $idPkReal)
                                                            ->update($value);
                                                }
                                            } else {
                                                //se não encontrar indice id, executa create save
                                                if (!in_array(null, $value)) {
                                                    //verifica se os valores não são null, caso for null não faz nada
                                                    $relac = $method->create($value);
                                                    $relac->save();
                                                }
                                            }
                                        }
                                    }
                                }
                                //}
                            }
                        }
                    }
                }
            }
            return $ret;
        } else {
            //sem relacionamento segue normal
            $data = Functions::decryptDataIndex($request, $module, $model);
            $data = DataReturn::readFile($model->getTable() . Crypt::decrypt($id), $data);
            if (count($data) > 0) {
                $query = $DataReturn->find($model, $id);
                $ret = $query->update($data);
                $DataReturn->createLog(__FUNCTION__, $query, $request, $data, $ret);
                return $DataReturn->returnMessage($ret);
            } else {
                return $DataReturn->returnMessage(count($data));
            }
        }
    }

    /* DELETE */

    public static function returnDataDestroyajax($model, $request, $id) {
        //função para excluir dado do sistema
        try {
            $DataReturn = new DataReturn();
            $data = Crypt::decrypt($id);
            $query = $DataReturn->find($model, $id);
            $ret = $query->delete();

            $DataReturn->createLog(__FUNCTION__, $query, $request, $data, $ret);
            return $DataReturn->returnMessage($ret);
        } catch (Exception $ex) {
            //Logs::log('error_' . __FUNCTION__, $ex);
            return $ex;
        }
    }

    /* SHOW DATA */

    public static function returnDataShow($model, $request, $module, $id = null, $config = '') {
        //monta retorno dos dados para metodo show.
        //envia os dados para preencher os dados no formulário.
        try {
            $function = new Functions();
            $Datareturn = new DataReturn();
            $configA = '';
            $configB = '';
            if ($config !== '') {
                $configA = '.' . $config;
                $configB = $config . '.';
            }
            if (!is_null($id)) {
                $modelReturn = $Datareturn->find($model, $id);
                $Datareturn->createLog(__FUNCTION__, $modelReturn, $request);
                $idRet = $modelReturn->id;
                if (is_null($idRet)) {
                    $idRet = $modelReturn->toArray();
                    $idRet = reset($idRet);
                }
                $title = DataReturn::config_lang($module, $configB . 'lang.data-maintenance');
                $route = DataReturn::mount_route($module . $configA . '.routes.update.name', $idRet);
                $namestr = ''; //DataReturn::config_lang($module, 'lang.data-userid');
                $wildcard = DataReturn::config_lang($module, $configB . 'lang.show-update');
            } else {
                $modelReturn = '';
                $idRet = '';
                $title = DataReturn::config_lang($module, $configB . 'lang.data-creater');
                $route = DataReturn::mount_route($module . $configA . '.routes.create.name');
                $namestr = '';
                $wildcard = DataReturn::config_lang($module, $configB . 'lang.show-creat');
            }
            return [
                'wildcard' => $wildcard,
                'title' => $title,
                'route' => $route,
                'routeCreate' => DataReturn::mount_route($module . $configA . '.routes.new.name'),
                'namestr' => $namestr,
                'moduleView' => $module . '::',
                'data' => DataReturn::selectTable(
                        [
                            'model' => $modelReturn,
                            'module' => $module,
                            'only' => 'obj'
                        ]
                ),
                'relacional' => $function->showTablesAll($model, $id),
            ];
        } catch (Exception $ex) {
            //Logs::log('error_' . __FUNCTION__, $ex);
            return $ex;
        }
    }

    /* INDEX TABLE ALL DATA */

    public static function returnDataTable($model, $module, $selectTable = null, $config = '') {
        //$model objeto instanciado na controller e enviado no parâmetro. Exempo: $model = new User();
        //$module nome do módulo. Exemplo: $this->module = 'user'
        //config usada. Exemplo: $model->all(config('user.select-table'));
        /* Exemplo:
         * 'select-table' =>
          [
          'id as ID',
          'avatar as Avatar',
          'name as Nome',
          'email as E-Mail',
          'active as Status',
          'created_at as Criado',
          'updated_at as Atualizado'
          ],
         */
        $configA = '';
        $configB = '';
        try {
            if (!is_null($selectTable)) {
                //obsoleto, testar para ver se existe necessidade ainda de utilizar essa parte
                $configTable = $selectTable;
            } else {
                $configTable = 'select-table';
            }
            if ($config !== '') {
                $configA = '.' . $config;
                $configB = $config . '.';
            }
            $modelReturn = $model->all(config($module . $configA . '.' . $configTable));

            return [
                'wildcard' => DataReturn::config_lang($module, $configB . 'lang.table-list'),
                'routeCreate' => DataReturn::mount_route($module . $configA . '.routes.new.name'),
                'routeEdit' => $module . $configA . '.routes.show.name',
                'routeDestroy' => $module . $configA . '.routes.destroy.name',
                'routeAjax' => DataReturn::mount_route($module . $configA . '.routes.ajax.name'),
                'data' => DataReturn::selectTable(
                        [
                            'model' => $modelReturn,
                            'module' => $module,
                            'body' => true
                        ]
                )
            ];
        } catch (Exception $ex) {
            //Logs::log('error_' . __FUNCTION__, $ex);
            return $ex;
        }
    }

    /* functions protected */

    protected static function selectTable($array = false) {
        //metodo responsavel por manipular o retorno dos dados da model
        //possui dois diferentes tipo de retorno 
        //para montar tabela dinâmica e retorno em objeto para fomulários

        try {
            $model = array_key_exists('model', $array) ? $array['model'] : false;
            if ($model) {

                $module = array_key_exists('module', $array) ? $array['module'] : '';
                $body = array_key_exists('body', $array) ? $array['body'] : false;

                $obj = $model->toArray();
                if ($body) {
                    $data['columns'] = [];
                    for ($i = 0; $i < count($obj); $i++) {
                        if (count($obj) > 0) {
                            foreach ($obj[$i] as $key => $value) {
                                //Para não repetir nomes das colunas
                                if (array_search($key, $data['columns']) === false) {
                                    array_push($data['columns'], $key);
                                }
                            }
                        }
                    }
                }
                $data['module'] = $module;
                $data['model'] = $model;
                $data['data'] = $obj;
                $data['obj'] = (object) $obj;
                $data['json'] = json_encode($data);

                if ($body) {
                    $dataReturn = new DataReturn();
                    //adicionar colunas para ações ou extras
                    array_push($data['columns'], $dataReturn->edit);
                    array_push($data['columns'], $dataReturn->destroy);
                }
                $only = array_key_exists('only', $array) ? $array['only'] : false;
                switch ($only) {
                    case false:
                        $ret = $data;
                        break;
                    case 'obj':
                        $ret = (object) $data['obj'];
                        break;

                    default:
                        $ret = $data;
                        break;
                }
                return $ret;
            }
        } catch (Exception $ex) {
            //Logs::log('error_' . __FUNCTION__, $ex);
            return $ex;
        }
    }

    protected static function config_lang($module, $config) {
        return Functions::mount_config($module, $config);
    }

    protected function returnMessage($modelReturn) {
        switch ($modelReturn) {
            case 0:
                $message = 'empty-message';
                break;
            case true:
                $message = 'success-message';
                break;

            case false:
                $message = 'error-message';
                break;

            default:
                break;
        }

        return $message;
    }

    protected function createLog($function, $query, $request, $data = null, $ret = null) {
        if (is_null($data)) {
            //Logs::log($function, ' Result: ' . $ret . ' - Retorno da Model: ' . $query . ' - URL: ' . $request->method() . ' / ' . $request->url());
        } else {
            //Logs::log($function, ' Result: ' . $ret . ' - Retorno da Model: ' . $query . ' - URL: ' . $request->method() . ' / ' . $request->url() . ' - Request: ' . json_encode($data));
        }
    }

    protected function find($model, $id) {
        $return = $model->findOrFail(Crypt::decrypt($id));
        DataReturn::creatFile($return);
        return $return;
    }

    public static function mount_route($routeName, $id = null) {
        $func = new Functions();
        if ($func->checkRoute($routeName) !== false) {
            if (isset($id)) {
                $id = (int) $id;
                //revisar para listar as routas para confirmar se existe
                return route(config($routeName), @encrypt($id));
            } else {
                return route(config($routeName));
            }
        } else {
            return false;
        }
    }

    protected static function creatFile($data) {
        $DataReturn = new DataReturn();

        $idRet = $data->id;
        if (is_null($idRet)) {
            $idRet = $data->toArray();
            $idRet = reset($idRet);
        }


        $file = $data->getTable() . $idRet . '.json';
        $dir = $DataReturn->dir;
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
        }
        $path = $dir . $file;
        $handle = fopen($path, 'w+');
        fwrite($handle, $data->toJson());
        fclose($handle);
    }

    protected static function readFile($file, $data) {
        //faz verificação nos dados de request comparado ao arquivo txt com cópia do dados do banco
        //caso tenha dados diferentes, ele atualzia o array somente com os valores necessário
        //que realmente foram modificados
        $DataReturn = new DataReturn();
        $fileLoad = $DataReturn->dir . $file . '.json';
        $arrayReturn = [];
        if (file_exists($fileLoad)) {
            $fileRead = json_decode(file_get_contents($fileLoad));

            foreach ($fileRead as $keyline => $valueline) {
                foreach ($data as $key => $value) {
                    if ($key === $keyline) {
                        if ($value !== strval($valueline)) {
                            $arrayReturn[$key] = $value;
                        }
                    }
                }
            }
        } else {
            $arrayReturn = $data;
        }

        return $arrayReturn;
    }

}

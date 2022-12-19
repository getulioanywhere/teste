<?php

namespace App\Classes;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use function config;
use function GuzzleHttp\json_decode;
use function trans;

/**
 * ALTERAÇÕES NESSE ARQUIVO, SOMENTE COM AUTORIZAÇÃO DO GETULIO
 *
 * 
 */
class Functions {

    protected function validateDate($date, $format = 'Y-m-d H:i:s') {
        //verifica se é tipo data e confirma com true ou false
        if (strpos($date, '.000') !== false) {
            $explode = explode('.', $date);
            $date = $explode[0];
        }
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function convertDate($date) {
        $functions = new Functions();
        if ($functions->validateDate($date)) {
            $explode = explode('-', $date);
            $y = $explode[0];
            $m = $explode[1];

            $explodeB = explode(' ', $explode[2]);
            $d = $explodeB[0];

            $explodeC = explode('.', $explodeB[1]);

            $h = $explodeC[0];
            $h = str_replace('00:00:00', '', $h);

            return $d . '-' . $m . '-' . $y . PHP_EOL . $h;
        } else {
            return $functions->numberToMoney($date);
        }
    }

    public static function generateRandomString($array = false) {
        $qtyCaraceters = 8;
        $onlyNumbers = false;
        $onlyCapital = false;
        $specialChars = true;
        if ($array !== false) {
            $qtyCaraceters = array_key_exists('qtyCaraceters', $array) ? intval($array['qtyCaraceters']) : 8;
            $onlyNumbers = array_key_exists('onlyNumbers', $array) ? $array['onlyNumbers'] : false;
            $onlyCapital = array_key_exists('onlyCapital', $array) ? $array['onlyCapital'] : false;
            $specialChars = array_key_exists('specialChars', $array) ? $array['specialChars'] : true;
        }

        $smallLetters = $onlyCapital || $onlyNumbers ? '' : str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $capitalLetters = $onlyNumbers ? '' : str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $specialCharacters = $specialChars && !$onlyNumbers ? str_shuffle('!@#$%*-') : '';
        $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;
        $randomString = substr(str_shuffle($characters), 0, $qtyCaraceters);
        return $randomString;
    }

    public static function mount_config($module, $config) {
        return $module . '::' . $module . '.' . config($module . '.' . $config);
    }

    public static function mount_component_config($module, $config, $component) {
        $configModule = config("$module.$config");
        return "$module::$module.$component.$configModule";
    }

    public static function decryptDataIndex($request, $module = null, $model = null) {

        if ($request) {
            foreach ($request->all() as $key => $value) {
                if ($key !== '_token' && $key !== '_method') {

                    try {
                        $index = Crypt::decrypt($key);
                    } catch (DecryptException $exc) {
                        $index = $key;
                    }


                    if ($request->hasFile($key) && $request->file($key)->isValid()) {
                        $name = uniqid(date('HisYmd'));
                        $extension = $request->file($key)->extension();
                        $nameFile = $name . '.' . $extension;
                        $arrayReturn[$index] = $nameFile;

                        $path = $module . '/' . $index;
                        $arrayReturn['path_' . $index] = $path . '/' . $nameFile;
                        if (!is_null($module)) {
                            try {
                                $upload = $request->file($key)->storeAs('public/' . $path, $nameFile);
                                if (!$upload) {
                                    //Logs::log('error_upload_' . __FUNCTION__, ' Linha:' . __LINE__ . ' Erro upload: ' . $upload);
                                }
                            } catch (Exception $ex) {
                                //Logs::log('error_upload_' . __FUNCTION__, ' Linha:' . __LINE__ . ' Erro upload: ' . $ex);
                            }
                        }
                    } else {
                        if (strpos($index, '_link') !== false) {
                            if ($value === null || $value === '') {
                                $explode = explode('_link', $index);
                                $arrayReturn[$explode[0]] = '';
                                $arrayReturn['path_' . $index] = '';
                            }
                        } else {
                            if (is_array($value)) {
                                $arrayReturn[$index] = $value;
                            } else {
                                $arrayReturn[$index] = $value;
                            }
                        }
                    }
                }
            }
            return $arrayReturn;
        }
    }

    public static function isMobile() {
        $is_mobile = false;

        //Se tiver em branco, não é mobile
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            $is_mobile = false;

            //Senão, se encontrar alguma das expressões abaixo, será mobile
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) {
            $is_mobile = true;

            //Senão encontrar nada, não será mobile
        } else {
            $is_mobile = false;
        }

        return $is_mobile;

        /* EXEMPLO DE USO
          if (isMobile())
          echo 'Navegação em Dispositivo Móvel';
          else
          echo 'Navegação em Desktop';

          echo '<br><br>';

          echo '<b>HTTP_USER_AGENT: '.$_SERVER['HTTP_USER_AGENT'].'</b>';
         */
    }

    public static function isFileImg($file) {
        if ($file !== '' && !is_null($file)) {
            return file_exists('storage/' . $file);
        }
        return false;
    }

    //funções para remover indices do array
    public function removeButtonCreate($process) {
        unset($process[1]['routeCreate']);
        return $process;
    }

    public function modifyColumnName($process, $columnOld, $newColumnName) {
        //caso necessite modificar o name de alguma coluna.
        //para editar e deletar, necessário estudo para automatizar
        $columns = $process[1]['data']['columns'];
        foreach ($columns as $key => $value) {

            if ($value === $columnOld) {
                $process[1]['data']['columns'][$key] = $newColumnName;
            }
        }
        return $process;
    }

    public function removeButtonEdit($process) {
        $functions = new Functions();
        return $functions->unsetColumn($process, 'Editar');
    }

    public function removeButtonDelete($process) {
        $functions = new Functions();
        return $functions->unsetColumn($process, 'Deletar');
    }

    protected function unsetColumn($process, $columnName) {
        $columns = $process[1]['data']['columns'];
        foreach ($columns as $key => $value) {

            if ($value === $columnName) {
                unset($process[1]['data']['columns'][$key]);
            }
        }
        return $process;
    }

    public static function checkButtonsExists($routeCreate) {
        //para inclusão de mais botões dentro do array
        $array = [];
        $create = isset($routeCreate) ? [
            'locationhref' => $routeCreate,
            'text' => 'Cadastrar Novo',
            'bgcolor' => 'bg-gradient-primary'
                ] : null;
        if (!is_null($create)) {
            array_push($array, $create);
        }
        return $array;
    }

    public function createButtonTable($process, array $options = []) {

        if (array_key_exists('button', $process[1])) {
            $array = [];
            $button = $process[1]['button'];
            for ($x = 0; $x < count($button); $x++) {
                array_push($array, $button[$x]);
            }
            for ($i = 0; $i < count($options); $i++) {
                array_push($array, $options[$i]);
            }
            $process[1]['button'] = $array;
        } else {
            $process[1]['button'] = $options;
        }
        return $process;
    }

    public static function localeDateTime($date) {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format(trans('locale.datetime'));
        }
        return \DateTime::createFromFormat(trans('locale.datetime'), $date);
    }

    public static function localeDate($date) {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format(trans('locale.date'));
        }
        return \DateTime::createFromFormat(trans('locale.date'), $date);
    }

    public function checkRoute($routeName) {
        $ret = false;
        foreach (Route::getRoutes()->getRoutesByName() as $key => $value) {
            if ($key === config($routeName)) {
                $ret = $routeName;
            }
        }
        return $ret;
    }

    public function numberToMoney($value) {
        $int = (int) $value;
        $float_value = (float) $value;
        if (strval($float_value) == $value && strval($int) !== $value) {
            //é número float
            if (is_int($value)) {
                return $value;
            } else {
                $val = floatval($value);
                $ret = number_format($val, 2, ',', '.');
                return str_replace(' ', '', $ret);
            }
        } else {
            //não é número float
            return $this->numberToSql($value);
        }
    }

    public function numberToSql($value) {
        //testa para confirmar se é float
        $valA = strpos($value, '.') !== false ? str_replace('.', '', $value) : $value;
        $valB = strpos($value, ',') !== false ? str_replace(',', '.', $valA) : $valA;
        $val = str_replace(' ', '', $valB);
        $int = (int) $val;
        $float_value = (float) $val;
        if (strval($float_value) == $val && strval($int) !== $val) {
            //é float
            return $val;
        } else {
            //não é float, retorna o seu valor normal
            return $value;
        }
    }

    public static function statusInTable($value) {
        $value = (int) $value;
        switch ($value) {
            case 1:
                return 'table.status.active';

                break;
            case 0:
                return 'table.status.inactive';

                break;
            default:
                break;
        }
    }

    public function server() {
        $system = PHP_OS;
        if (strpos(php_uname(), '(Windows 10)') !== false) {
            $system = 'Linux';
        }
        switch ($system) {
            case 'WINNT':
                $php = '"C:\Program Files (x86)\Plesk\Additional\PleskPHP81\php.exe"';
                $composer = '"C:\Program Files (x86)\Plesk\Additional\PleskPHP81\php.exe" "%plesk_dir%Additional\Composer\composer.phar"';
                break;

            case 'Linux':
                $php = 'php';
                $composer = 'composer';
                break;

            default:
                $php = 'php';
                $composer = 'composer';
                break;
        }

        return ['php' => $php, 'composer' => $composer];
    }

    public function modules() {

        if (file_exists('modules_statuses.json')) {
            $array = json_decode(file_get_contents('modules_statuses.json'));
            $arrayExit = [];
            foreach ($array as $key => $value) {
                array_push($arrayExit, $key);
            }
            return $arrayExit;
        }
    }

    public function showTablesAll($model, $id = null) {

        if (!is_null($model)) {
            $name_table = $model->getTable();
            $connect = $model->getConnection()->getName();
        }

        if ($connect === 'mysql') {
            $foreing = 'FOREIGN KEY';
            $references = 'REFERENCES';
            $createtable = 'Create Table';
            $table = 'Table';
            $ret = [];
            $tables = DB::select('SHOW TABLES');
            $teste = []; //para teste
            for ($i = 0; $i < count($tables); $i++) {
                foreach ($tables[$i] as $key => $tableValue) {
                    $select = DB::select('SHOW CREATE TABLE ' . $tableValue);
                    array_push($teste, $select); //para teste
                    for ($x = 0; $x < count($select); $x++) {
                        $tableIn = (array) $select[$x];
                        $tableName = $tableIn[$table];
                        $tableShow = $tableIn[$createtable];
                        array_push($ret, $tableIn);
                    }
                }
            }
            //$teste, usar para teste de verificação completa de tudo que vem das tabelas
            //dd($teste);
            for ($j = 0; $j < count($ret); $j++) {

                $create = $ret[$j][$createtable];
                $tableName = $ret[$j][$table]; //nome da tabela
                $array[$tableName] = [];

                if (strpos($create, $foreing) !== false) {
                    $explode = $this->getExplode(',', $create);
                    for ($k = 0; $k < count($explode); $k++) {

                        if (strpos($explode[$k], $references) !== false) {
                            $explode2 = $this->getExplode($references, $explode[$k]);

                            for ($l = 0; $l < count($explode2); $l++) {
                                if (strpos($explode2[$l], $foreing) !== false) {
                                    $explode3 = $this->getExplode('FOREIGN KEY (`', $explode2[$l]);
                                    $explode4 = $this->getExplode('`)', $explode3[1]);

                                    $explode5 = $this->getExplode('REFERENCES `', $explode[$k]);
                                    $explode6 = $this->getExplode('`', $explode5[1]);

                                    array_push($array[$tableName], [
                                        'foreing' => $explode4[0],
                                        'table' => $explode6[0],
                                        'key' => $explode6[2]
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            return $this->relation($this->checkForeing($array, $name_table), $model, $id);
        }
    }

    protected function getExplode($separator, $string) {
        return explode($separator, $string);
    }

    protected function checkForeing($array, $table) {
        //separa todos os relacionamentos que pertecem a tabela.
        $find = [];
        foreach ($array as $key => $value) {
            if (count($value) > 0) {
                for ($i = 0; $i < count($value); $i++) {
                    if (array_key_exists('table', $value[$i])) {
                        if ($value[$i]['table'] === $table) {
                            $find[$key] = [];
                            for ($k = 0; $k < count($value); $k++) {
                                array_push($find[$key], $value[$k]);
                            }
                        }
                    }
                }
            }
        }

        return $find;
    }

    protected function relation($showtables, $model, $id = null) {
        //executa os relacionamentos na model
        $ret = [];
        foreach ($showtables as $key => $value) {

            if (method_exists($model, $key) === true) {
                if (!is_null($id)) {
                    $idCrypt = Crypt::decrypt($id);
                    //array_push($ret, [
                    $ret[$key] = $model->{$key}($idCrypt);
                    //]);
                }
            }
        }
        return $ret;
    }

    public function execTable($table, $column, $idMain, $idObj, $modelRela) {
        $ids = [];
        $query = DB::table($table)
                ->where($column, '=', $idMain)
                ->get()
                ->toArray();

        foreach ($query as $value) {
            array_push($ids, $value->{$idObj});
        }
        $attr = [];
        foreach ($ids as $key => $value) {
            $exec = $modelRela->where('id', '=', $value)->get()->toArray();
            array_push($attr, reset($exec));
        }

        return $attr;
    }

    public function separatorTable($array, $request) {
        //função experimental para separar tabelas 
        $data = Functions::decryptDataIndex($request);
        $separator = '_table_table_'; //criar nas classes das views dos componentes
        for ($i = 0; $i < count($array); $i++) {
            $tables[$array[$i]] = [];
            foreach ($data as $key => $value) {
                if (strpos($key, $array[$i] . $separator) !== false) {
                    $explode = explode($array[$i] . $separator, $key);
                    if ($key === $array[$i] . $separator . $explode[1]) {
                        $tables[$array[$i]] += [$explode[1] => $value];
                    }
                }
            }
        }
        return $tables;
    }

    public function descrypt($id) {

        $int = (int) $id;
        if (strval($int) === $id) {
            //é int
            return $int;
        } else {
            try {
                $idPk = Crypt::decrypt($id);
            } catch (DecryptException $exc) {
                $idPk = $id;
            }
        }

        return $idPk;
    }

    /* public function migrate_modules() {
      $func = new Functions();
      $module = $func->modules();
      $php = $func->server();
      foreach ($module as $key => $value) {
      system($php['php'] . ' artisan module:migrate ' . $module);
      }
      foreach ($module as $key => $value) {
      system($php['php'] . ' artisan module:seed ' . $module);
      }
      return true;

      } */
}

<?php

namespace Modules\MenuSystem\Http\Controllers;
//use Illuminate\Support\Facades\DB;


use App\Classes\Functions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Modules\MenuSystem\Models\MenuSystem;

class MenuSystemController extends Controller {

    public function create() {
        $model = new MenuSystem();
        $functions = new Functions();
        
        //$model->truncate();        
        //echo 'Truncate! '. PHP_EOL;
        //die();
        //DB::table($model->getTable())->delete();
        
        $config = $functions->modules();
        
        if (isset($config) && !is_null($config)) {
            foreach ($config as $module) {
                $configA = '';
                if (!is_null($module)) {
                    $module = mb_strtolower($module);
                    
                    //busca informações da config do módulo
                    $options = config($module);
                    //Aqui verifica se existe mais de uma config no módulo.
                    //Caso exista, ele vai buscar pela config Pai (config.php). 
                    //Onde deve ter as informações do menu do módulo
                     if (is_array($options)) {
                        $configA = array_key_exists('config', $options) ? '.config' : '';
                    }

                    $menu_module_name = config($module . $configA . '.name');
                    $menu_main = config($module . $configA . '.menu');

                    if (!is_null($menu_main)) {
                        $model->menu_module_name = $menu_module_name;
                        $model->menu_main = $menu_main;

                        $check = $model->where(['menu_module_name' => $menu_module_name]);
                        if ($check->count() == 0) {
                            echo $menu_module_name . ' menu create result:' . $model->save() . PHP_EOL;
                        } else {
                            $data = $check->first();

                            $ret = $model->where(['id' => $data->id])->update(
                                    [
                                        'menu_module_name' => $menu_module_name,
                                        'menu_main' => $model->menu_main,
                                    ]
                            );
                            echo $menu_module_name . ' menu Update result:' . $ret . PHP_EOL;
                        }
                    } else {
                        echo $menu_module_name . ' menu do not exist' . PHP_EOL;
                    }
                } else {
                    echo $module . ' module do not exist' . PHP_EOL;
                }
            }
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            Artisan::call('route:clear');

            echo 'All Caches Clear!' . PHP_EOL;
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('menusystem::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        return view('menusystem::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        //
    }

}

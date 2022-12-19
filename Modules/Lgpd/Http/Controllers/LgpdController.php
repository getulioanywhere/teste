<?php
namespace Modules\Lgpd\Http\Controllers;
use Modules\Lgpd\Models\Lgpd;
use App\Classes\Process;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Classes\Functions;
use App\Classes\DataReturn;

class LgpdController extends Controller {

    protected $module = 'lgpd'; //nome do módulo
    protected $model;
    protected $process;
    protected $functions;

    public function __construct() {
        $this->model = new Lgpd();
        $this->process = new Process($this->model, $this->module);
        $this->functions = new Functions();
    }
    public function index() {
        //Listagem em tabela 
        $process = $this->process->index();
        $process = $this->functions->removeButtonCreate($process);
        $process = $this->functions->removeButtonEdit($process);
        $process = $this->functions->removeButtonDelete($process);
        $process = $this->functions->createButtonTable($process,
                [
                    [
                        'locationhref' => DataReturn::mount_route($this->module . '.routes.show.name', 1),
                        'text' => 'Editar Página e Modal',
                        'bgcolor' => 'bg-gradient-success'
                    ]
                ]
        );
        return view($process[0], $process[1]);
    }    
}
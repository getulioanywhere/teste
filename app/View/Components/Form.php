<?php

namespace App\View\Components;

use App\Classes\Functions;
use Illuminate\View\Component;

class Form extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $action;
    public $method;
    public $id;
    public $enctype;

    public function __construct($action = null, $method, $id='', $enctype = null) {
        $this->action = $action;
        $this->method = $method;
        $this->id = isset($id) && !empty($id) ? $id : 'formid-'.Functions::generateRandomString(['specialChars' => false,'qtyCaraceters'=>20]);
        $this->enctype = $enctype;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.elements.form');
    }

}

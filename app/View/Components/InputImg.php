<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class InputImg extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $value;
    public $labelTextfield;
    public $buttonTextfield;
    public $tableName;

    public function __construct(
            $labelTextfield = '',
            $buttonTextfield = '',
            $name,
            $value = '',
            $tableName = '',
            $encrypt = null
    ) {
        $this->labelTextfield = $labelTextfield ? $labelTextfield : 'Image';
        $this->buttonTextfield = $buttonTextfield ? $buttonTextfield : 'Enviar';

        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }

        if (is_null($encrypt)) {
            $this->name = Crypt::encrypt($this->tableName . $name);
        } else {
            $this->name = $this->tableName . $name . '[]';
        }

        $this->value = !is_null($value) && isset($value) && !empty($value) ? $value : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.elements.input-img');
    }

}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioButton extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label;
    public $labela;
    public $labelb;
    public $value;
    public $name;
    public $tableName;

    public function __construct($labela = '',
            $labelb = '', $value, $name,
            $label = '',
            $tableName = ''
    ) {
        $this->label = isset($label) && !empty($label) ? $label : '';
        $this->labela = $labela;
        $this->labelb = $labelb;
        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }
        $this->name = $this->tableName . $name;

        if (is_object($value)) {
            $this->value = $value->{$name};
        } else {
            $this->value = 1;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.elements.radio-button');
    }

}

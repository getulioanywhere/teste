<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class Checkbox extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label;
    public $value;
    public $name;
    public $id;
    public $checked;
    public $tableName;

    public function __construct($value,
            $name,
            $label = '',
            $id = '',
            $checked = '',
            $idvalue = '',
            $tableName = '',
            $encrypt = null) {

        $this->label = isset($label) && !empty($label) ? $label : '';
        $this->id = isset($id) && !empty($id) ? $id : '';

        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }
        
        if (is_null($encrypt)) {
            $this->name = Crypt::encrypt($this->tableName . $name);
        } else {
            $this->name = $this->tableName . $name.'[]';
        }

        $this->checked = '';
        if (isset($checked) && (is_object($checked) || is_array($checked)) && isset($idvalue)) {
            foreach ($checked as $check) {

                if (reset($check) === $idvalue) {
                    $this->checked = 'checked';
                }
            }
        } else {
            $this->checked = '';
        }


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
        return view('components.elements.checkbox');
    }

}

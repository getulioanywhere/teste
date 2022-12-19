<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class Input extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $label;
    public $icon;
    public $type;
    public $class;
    public $placeholder;
    public $value;
    public $data;
    public $tableName;

    public function __construct($label = '',
            $icon = '', $type = 'text',
            $class = '', $placeholder = '',
            $name = '', $id = '', $value = null, $tableName = '', $encrypt = null, $nameArray = null, $index = null) {
        $this->label = $label;
        $this->icon = $icon;
        $this->type = $type;
        $this->class = $class;
        $this->id = $id;

        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }

        if (is_null($encrypt)) {
            $this->name = Crypt::encrypt($this->tableName . $name);
        } else {
            if(!is_null($nameArray) && !is_null($index)){
                //'<input type="text" name="players['.$i.'][firstName]" value="'.$fName.'" />';
                $this->name = $this->tableName . $name . '['.$index.'][' . $nameArray . ']';
            }else{
                $this->name = $this->tableName . $name . '[]';
            }
            
        }

        $this->placeholder = $placeholder;

        if (!is_null($value) && is_object($value)) {
            $this->value = $value->{$name};
        } else {
            $this->value = !is_null($value) && isset($value) && !empty($value) ? $value : '';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.elements.input');
    }

}

<?php

namespace App\View\Components;

//use Illuminate\Support\Facades\Blade;


use Illuminate\Support\Facades\Crypt;
use Illuminate\View\Component;

class TextArea extends Component {

    public $name;
    public $value;
    public $label;
    public $class;
    public $rows;
    public $cols;
    public $tableName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = '', $label = '', $class = null, $rows = null, $cols = null,
            $value = null, $tableName = '', $encrypt = null, $nameArray = null, $index = null) {

        $this->label = $label;

        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }

        if (is_null($encrypt)) {
            $this->name = Crypt::encrypt($this->tableName . $name);
        } else {
            if(!is_null($nameArray)){
                //'<input type="text" name="players['.$i.'][firstName]" value="'.$fName.'" />';
                $this->name = $this->tableName . $name . '['.$index.'][' . $nameArray . ']';
            }else{
                $this->name = $this->tableName . $name . '[]';
            }
        }

        $this->class = is_null($class) ? 'summernote' : $class;
        $this->rows = is_null($rows) ? '' : $rows;
        $this->cols = is_null($cols) ? '' : $cols;

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
        return view('components.elements.textarea');
    }

}

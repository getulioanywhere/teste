<?php

namespace App\View\Components;

use App\Classes\Functions;
use Illuminate\View\Component;

class Select extends Component {

    public $id;
    public $idvalue;
    public $name;
    public $label;
    public $options = [];
    public $selected;
    public $tableName;

    public function __construct($options = null, $name, $label = '', $id = '', $selected = '', 
            $idvalue = '', $tableName = '') {

        $this->label = isset($label) && !empty($label) ? $label : '';
        $this->id = isset($id) && !empty($id) ? $id : Functions::generateRandomString(['specialChars' => false, 'qtyCaraceters' => 20]);
        $this->idvalue = isset($idvalue) && !empty($idvalue) ? $idvalue : '';
        
        if (isset($tableName) && !empty($tableName)) {
            $this->tableName = $tableName . '_table_table_';
        } else {
            $this->tableName = '';
        }
        $this->name = $this->tableName . $name;
        
        
        $this->options = '';
        $this->selected = $selected;

       

        if (isset($options) && (is_object($options) || is_array($options))) {
            for ($i = 0; $i < count($options); $i++) {
                if(is_object($options[$i])){
                    $opt = (array)$options[$i];
                }else{
                    $opt = $options[$i];
                }
                
                if (isset($opt['id']) && isset($opt['title'])) {
                    $select = '';
                    if (isset($selected) && (is_object($selected) || is_array($selected))) {
                        for ($x = 0; $x < count($selected); $x++) {
                            if(reset($selected[$x]) === $opt['id']){
                                $select = 'selected';
                            }
                        }
                    }
                    $this->options .= '<option '.$select.' value="' . $opt['id'] . '" id="' . $opt['id'] . '">' . $opt['title'] . '</option>';
               }
            }
        }
        
    }

    public function render() {
        return view('components.elements.select');
    }

}

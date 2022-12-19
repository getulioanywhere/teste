<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    /*
     * class bg color = 
      bg-gradient-primary ou bg-primary
      bg-gradient-success ou bg-success
      bg-gradient-warning ou bg-warning
      bg-gradient-danger ou bg-danger

      target modal =
      data-target="#modal-default" usar default
      data-target="#modal-sm" usar sm
      data-target="#modal-lg" usar lg
      data-target="#modal-xl" usar xl

      icon = <i class="fas fa-save"></i> usar fas fa-save
      text = Modal Default
     */
    public $array = [];

    public function __construct($array = null) {
        $this->array = $array;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.elements.button');
    }

}

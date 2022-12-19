<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tab extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $titlestr;
    public $namestr;
    

    public function __construct($titlestr, $namestr) {
        $this->titlestr = $titlestr;
        $this->namestr = $namestr;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.tab.tab');
    }

}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabListNav extends Component {

    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $id;
    public $title;
    public $active;    
    public $selected;    

    public function __construct($id, $title,  $active = '', $selected = 'false') {
        $this->id = $id;
        $this->title = $title;
        $this->active = $active;        
        $this->selected = $selected;        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.tab.tab-list-nav');
    }

}

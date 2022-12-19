<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TabContent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $active;
    public function __construct($id, $active = '')
    {
        $this->id = $id;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tab.tab-content');
    }
}

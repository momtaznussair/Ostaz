<?php

namespace App\View\Components;

use Illuminate\View\Component;

class crudByNameModal extends Component
{
    public $mode, $title, $name;
    public function __construct($mode, $title, $name)
    {
        $this->mode = $mode;
        $this->title = $title;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.crud-by-name-modal');
    }
}

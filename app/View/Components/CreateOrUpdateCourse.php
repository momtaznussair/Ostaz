<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CreateOrUpdateCourse extends Component
{
    public $mode, $title, $categories, $instructors;
    public function __construct($mode, $title, $categories, $instructors)
    {
        $this->title = $title;
        $this->mode = $mode;
        $this->categories = $categories;
        $this->instructors = $instructors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.create-or-update-course');
    }
}

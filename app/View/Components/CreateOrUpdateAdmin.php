<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CreateOrUpdateAdmin extends Component
{
    public $mode , $title, $allRoles, $avatar, $admin;
    public function __construct($mode , $title, $allRoles, $avatar, $admin)
    {
        $this->mode = $mode;
        $this->title = $title;
        $this->allRoles = $allRoles;
        $this->avatar = $avatar;
        $this->admin = $admin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.create-or-update-admin');
    }
}

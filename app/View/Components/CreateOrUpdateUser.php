<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CreateOrUpdateUser extends Component
{
    public $mode, $title, $user, $type, $avatar, $countries, $cities;
    public function __construct($mode, $title, $user, $type, $avatar, $countries, $cities)
    {
        $this->mode = $mode;
        $this->title = $title;
        $this->user = $user;
        $this->type =$type;
        $this->avatar = $avatar;
        $this->countries = $countries;
        $this->cities = $cities;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.create-or-update-user');
    }
}

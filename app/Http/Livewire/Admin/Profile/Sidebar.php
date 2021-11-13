<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['profileUpdated' => '$refresh', 'deleted' => '$refresh'];
    public function render()
    {
        return view('livewire.admin.profile.sidebar');
    }
}

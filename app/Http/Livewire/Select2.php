<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Select2 extends Component
{
    public $numbers;
    public $name = 'Momtaz';
    public function render()
    {
        return view('livewire.select2');
    }

    public function request()
    {
        $this->numbers = [1, 2];
    }

    // public function mount()
    // {
    //     $this->numbers = [1, 2];
    // }
    public function select()
    {
        // $this->numbers = [1, 2];
        $this->emit('show');
    }
    public function submit()
    {
        dd($this->numbers);
    }
}

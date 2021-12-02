<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use App\Traits\Auth\Admin\SendsPasswordResetLink;

class ForgotPassword extends Component
{

    use SendsPasswordResetLink;

    public $email;

    public $rules = [
        'email' => 'required|email'
    ];

    public function render()
    {
        return view('livewire.admin.auth.forgot-password');
    }

    public function updated($property)
    {
       $this->validateOnly($property);
    }
}

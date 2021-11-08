<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Traits\Auth\Admin\ResetsAdminPassword;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;

class ResetPassword extends Component
{
    use ResetsAdminPassword;

    public $email, $token, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.admin.auth.reset-password');
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function updated($property)
    {
       $this->validateOnly($property);
    }
}

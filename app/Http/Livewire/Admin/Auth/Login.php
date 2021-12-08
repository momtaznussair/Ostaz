<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password, $rememberMe;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.auth.login');
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function login()
    {
       $credentials = $this->validate();

       if(Auth::guard('admin')->attempt($credentials, $this->rememberMe)) {

            return redirect()->intended('/admin');
        }

    session()->flash('error', __('The provided credentials do not match our records.'));
    
    }
}

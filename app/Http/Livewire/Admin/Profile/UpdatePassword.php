<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;

class UpdatePassword extends Component
{
    public $admin, $current_password, $password, $password_confirmation;
    public function render()
    {
        return view('livewire.admin.profile.update-password');
    }

    protected function rules(){
        return [
            'current_password' => 'required|current_password:admin',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function save()
    {
        $this->validate();
        Auth('admin')->user()->password = Hash::make($this->password);
        Auth('admin')->user()->save();
        $this->reset();
        $this->emit('profileUpdated');
    }
}

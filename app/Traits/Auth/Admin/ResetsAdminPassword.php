<?php

namespace App\Traits\Auth\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

trait ResetsAdminPassword {
      /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }   

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function resetPassword()
    {
        $credentials = $this->validate();

        $response = $this->broker()->reset(
            $credentials , function ($admin, $password) {
                $admin->update([
                    'password' => Hash::make($password)
                ]);
                event(new PasswordReset($admin));
            }
        );

        if($response == Password::PASSWORD_RESET){
            return redirect()->route('admin.login')->with('status', __($response));
        }
        
        session()->flash('status', __($response));
    }
}
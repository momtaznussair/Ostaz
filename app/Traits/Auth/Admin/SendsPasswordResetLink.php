<?php

namespace App\Traits\Auth\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

trait SendsPasswordResetLink {

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


    public function sendPasswordResetLink()
    {
        $validEmail = $this->validate();

        //  We will send the password reset link to this admin. Once we have attempted
        //  to send the link, we will examine the response then see the message we
        //  need to show to the admin. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink($validEmail);

        if($response == Password::RESET_LINK_SENT){
            return session()->flash('status', __($response));
        }

        throw ValidationException::withMessages(['email' =>  __($response)]); 
    }

}
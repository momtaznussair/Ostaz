<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Str;
use App\Traits\Api\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    use ApiResponse;

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );


        return $status === Password::PASSWORD_RESET
            ? $this->apiResponse(null, __($status), 200)
            : $this->apiResponse(null, __($status), 400);
    }
}

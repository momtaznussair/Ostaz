<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ApiResponse;
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->apiResponse(null, __($status), 200)
            : $this->apiResponse(null, __($status), 400);
    }

    
}

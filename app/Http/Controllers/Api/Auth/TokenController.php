<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\UserRepositoryInterface;
use App\Traits\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    use ApiResponse;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        $credintials = $request->only(['emailOrPhone', 'password']);
        if(! Auth::guard('web')->attempt($this->credentials($request))){
            return $this->apiResponse(null, 'Invalid Credentials', 401);
        }

        $user = $this->userRepository->getByEmailOrPhone($request->emailOrPhone);

        $token = $user->createToken('access-token');
        return $this->apiResponse(['access-token' => $token->plainTextToken], 'User Logged In Successfully');
    }



    public function register(UserRegisterRequest $request)
    {
        $user = $this->userRepository->add($request->all());
        return $this->apiResponse(['user' => $user, 'access-token' => $user->createToken('access-token')->plainTextToken], 'User Created Successfully', 201);
    }

    protected function credentials($request)
    {
        $credentials = ['password' => $request->password];
        if(is_numeric($request->emailOrPhone)){
            $credentials['phone'] = $request->emailOrPhone;
        }else{
            $credentials['email'] = $request->emailOrPhone;
        }
        return $credentials;
    }
}

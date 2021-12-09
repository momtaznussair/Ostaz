<?php

namespace App\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAddressAndPhone;
use App\Http\Requests\Profile\UpdateBasicData;
use App\Http\Requests\Profile\UpdatePassword;
use App\Http\Resources\UserResourse;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Api\ApiResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ApiResponse;
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) {
       $this->userRepository = $userRepository;
    }
    
    public function profile(Request $request)
    {
        return $this->apiResponse(new UserResourse($request->user()), 'Current User Data');
    }

    public function updateBasicData(UpdateBasicData $request)
    {
        if($this->userRepository->update($request->user()->id, $request->only(['name', 'email', 'age', 'gender']))){
            return $this->apiResponse(null, 'Profile Updated Successfully');
        }
        return $this->UnknownError();
    }

    public function updateAddressAndPhone(UpdateAddressAndPhone $request)
    {
        if($this->userRepository->update($request->user()->id, $request->only(['city_id', 'phone']))){
            return $this->apiResponse(null, 'Profile Updated Successfully');
        }
        return $this->UnknownError();
    }

    public function updatePassword(UpdatePassword $request)
    {
        if($this->userRepository->update($request->user()->id, ['password' => Hash::make($request->password)])){
            return $this->apiResponse(null, 'Profile Updated Successfully');
        }
        return $this->UnknownError();
    }

    public function removeImage(Request $request)
    {
        if($this->userRepository->removeImage($request->user()->id)){
            return $this->apiResponse(null , 'Image Removed Successfully!');
        }
        return $this->UnknownError();
    }
}

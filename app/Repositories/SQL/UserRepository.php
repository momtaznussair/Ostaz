<?php

namespace App\Repositories\SQL;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface{

    public function __construct(User $user)
    {
        Parent::__construct($user);
    }

    public function add($attributes){
        $attributes['avatar'] &&  $attributes['avatar'] = $attributes['avatar']->store('users');
        $attributes['password'] && $attributes['password'] = Hash::make($attributes['password']);
        return  Parent::add($attributes);
    }

    public function getByEmailOrPhone($emailOrPhone)
    {
        if(is_numeric($emailOrPhone)){
            return User::where('phone', $emailOrPhone)->first();
        }
        return User::where('email', $emailOrPhone)->first();
    }

    public function updateOrCreate($attributes) {
        $attributes['avatar'] &&  $attributes['user']['avatar'] = $attributes['avatar']->store('users');
        $attributes['password'] && $attributes['user']['password'] = Hash::make($attributes['password']);
        return User::updateOrCreate(
            ['id' => $attributes['user']['id']], // condition
            $attributes['user'] // attributes
        );
    }

    public function removeImage($id){
        return $this->getById($id)
        ->update(['avatar' => 'users/default.jpg']);
    }
}
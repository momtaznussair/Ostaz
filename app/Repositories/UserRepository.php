<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true, $type = null, $country = null)
    {

       return User::search('name', $search)
       ->isTrashed($trashed)
       ->isActive($active)
       ->country($country)
       ->when($type, function ($query, $type) {
        return $query->where('type', $type);
        })
       ->paginate();
    }

    public function updateOrCreate($data) {
        $data['avatar'] &&  $data['user']['avatar'] = $data['avatar']->store('users');
        $data['password'] && $data['user']['password'] = Hash::make($data['password']);
        return User::updateOrCreate(
            ['id' => $data['user']['id']], // condition
            $data['user'] // attributes
        );
    }

    public function toggleActive($user, bool $active){
        return $user->update(['active' => !$active]);
    }

    public function remove($User)
    {
      return $User->delete();
    }

    public function restore($User)
    {
        return User::withTrashed()->find($User)->restore();
    }

    public function removeImage($user)
    {
        return $user->update(['avatar' => 'users/default.jpg']);
    }
}
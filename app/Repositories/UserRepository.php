<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true)
    {
       return User::search('name', $search)
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate();
    }

    public function getAllByType(string $search = '', bool $trashed = false, bool $active = true, string $type)
    {
       return User::with('city:id,name')
       ->search('name', $search)
       ->where('type', $type)
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate();
    }

    public function getById($id){
        # code...
    }

    public function add($data)
    {
        $data['avatar'] &&  $data['user']['avatar'] = $data['avatar']->store('users');
        $data['user']['password'] = Hash::make($data['password']);
        return User::create($data['user']);
    }

    public function update($user, $data)
    {
        dd($user->city_id);
       $data['avatar'] && $user->avatar = $data['avatar']->store('users');
       $data['password'] && $user->password = Hash::make($data['password']);
       return $user->save();
    }

    public function toggleActive($user, bool $active){
        return $user->update(['active' => !$active]);
    }

    public function remove($User)
    {
      return $User->delete();
    }

    public function getTrashed(string $keyword = '')
    {
        return  User::search('name', $keyword)->onlyTrashed()->paginate();
    }

    public function restore($User)
    {
        return User::withTrashed()->find($User)->restore();
    }
}
<?php

namespace App\Repositories\SQL;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminRepository extends Repository implements AdminRepositoryInterface{

    public function __construct(Admin $admin){
        parent::__construct($admin);
    }
    
    public function add($attributes){
        //save image if exista
        $attributes['avatar'] && $attributes['avatar'] = $this->saveImage($attributes['avatar']);
        //hash password
        $attributes['password'] = Hash::make($attributes['password']);
        $admin = Parent::add($attributes);
        return $attributes['roles']  && $admin->syncRoles($attributes['roles']);
    }

    public function updateOrCreate($data){
        $data['avatar'] && $data['admin']['avatar'] = $this->saveImage($data['avatar']);
        $data['password'] && $data['admin']['password'] = Hash::make($data['password']);
        $admin = Admin::updateOrCreate(
            ['id' => $data['admin']['id']], // condition
            $data['admin'] // attributes
        );
        return $data['roles']  && $admin->syncRoles($data['roles']);
    }

    private function saveImage($image){
        return $image->store('admins');
    }

    public function removeImage($id){
        return $this->model->update(['avatar' => 'admins/default.jpg']);
    }

}

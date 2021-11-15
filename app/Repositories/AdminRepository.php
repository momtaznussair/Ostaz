<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class AdminRepository implements AdminRepositoryInterface{

    public function getAll(string $keyword = '')
    {
        return Admin::paginate(10);
    }

    public function getById($id)
    {
        return Admin::find($id);
    }

    public function add($data)
    {
        $data['avatar'] &&  $data['admin']['avatar'] = $this->saveImage($data['avatar']);
        $data['admin']['password'] = Hash::make($data['password']);
        $admin = Admin::create($data['admin']);
        if($admin){
            $admin->syncRoles($data['roles']);
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        # code...
    }

    public function remove($id)
    {
       return Admin::find($id)->delete();
    }

    private function saveImage($image)
    {
        return $image->store('admins');
    }

    public function getTrashed()
    {
        # code...
    }

    public function restore($id)
    {
        # code...
    }
}
<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Contracts\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true)
    {
       return Admin::search('name', $search)
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate();
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

    public function update($admin, $data)
    {
        $data['avatar'] && $admin->avatar = $this->saveImage($data['avatar']);
        $data['avatar'] && $admin->password = Hash::make($data['password']);
        $admin->syncRoles($data['roles']);
        return $admin->save();
    }

    public function toggleActive($admin, bool $active){
        return $admin->update(['active' => !$active]);
    }

    public function remove($admin)
    {
       return $admin->delete();
    }

    private function saveImage($image)
    {
        return $image->store('admins');
    }

    public function removeImage(Admin $admin)
    {
        return $admin->update(['avatar' => 'admins/default.jpg']);
    }

    public function restore($admin)
    {
        return Admin::withTrashed()->find($admin)->restore();
    }
}
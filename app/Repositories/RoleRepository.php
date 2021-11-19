<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Contracts\RoleRepositoyInterface;

class RoleRepository implements RoleRepositoyInterface{

    public function getAll()
    {
       return Role::paginate(10);
    }

    public function add($data)
    {
        $role = Role::create([ 'name' => $data['name'] ]);
        if($role){
            $role->syncPermissions($data['permissions']);
            return true;
        }
        return false;
    }

    public function update($id, $data)
    {
        $role = Role::find($id);
        if($role){
            $role->update([
                'name' => $data['name'],
            ]);
            $role->syncPermissions($data['permissions']);
            return true;
        }
        return false;
    }

    public function remove($id)
    {
        $role = Role::find($id);
        if($role){
           $role->delete();
            return true;
        }
        return false;
    }
}
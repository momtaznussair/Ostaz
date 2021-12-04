<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Contracts\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true){
       return Role::paginate(10);
    }

    public function getById($id){
        return Role::find($id);
    }

    public function add($data){
        $role = Role::create([ 'name' => $data['name'] ]);
        if(!$role){
            return false;
        }
        $role->syncPermissions($data['permissions']);
        return true;
    }

    public function update($id, $data){
        $role = Role::find($id);
        if(!$role){
            return false;
        }
        $role->update([
            'name' => $data['name'],
        ]);
        $role->syncPermissions($data['permissions']);
        return true;
    }

    public function remove($id){
        $role = Role::find($id);
        if(!$role){
            return false;
        }
        $role->delete();
        return true;
    }

    public function restore($id){
        # code...
    }

    public function toggleActive($id, bool $active){
        # code...
    }
}
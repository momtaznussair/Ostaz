<?php

namespace App\Repositories\SQL;

use Spatie\Permission\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends Repository implements RoleRepositoryInterface{

    public function __construct(Role $role)
    {
        Parent::__construct($role);
    }

    public function getAll($active = true, $filters = [], $paginate = 15){
        $query = $this->model->query();
        //applying filters if exists
        foreach($filters as $filter => $value){
            $query->{$filter}($value);
        }

        return $query->paginate($paginate);
    }

    public function add($attributes){
        $role = Parent::add(['name' => $attributes['name']]);
        if(!$role){
            return false;
        }
        $role->syncPermissions($attributes['permissions']);
        return true;
    }

    public function update($id, $attributes){
        Parent::update($id, $attributes);
        $this->getById($id)->syncPermissions($attributes['permissions']);
        return true;
    }
}
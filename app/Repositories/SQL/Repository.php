<?php

namespace App\Repositories\SQL;

use App\Repositories\Contracts\RepositoryInterface;

abstract class Repository implements RepositoryInterface{
    protected $model;

    public function __construct($model)
    {
       $this->model = $model;
    }

    public function getAll($active = true, $filters = [], $paginate = 15){
        //get only active 
        $query = $this->model->query()->isActive($active);
        //applying filters if exists
        foreach($filters as $filter => $value){
            $query->{$filter}($value);
        }

        return $query->paginate($paginate);
    }

    public function getById($id){
        return $this->model::find($id);
    }

    public function add($attributes){
        return $this->model->create($attributes);
    }

    public function update($id, $attributes){
        return $this->getById($id)
        ->update($attributes);
    }

    public function toggleActive($id, bool $active){
        return $this->getById($id)
        ->update(['active' => !$active]);
    }

    public function remove($id){
        $model =  $this->getById($id);
        $model->update(['active' =>  false]);
        return $model->delete();
    }

    public function restore($id){
        $model =  $this->model::withTrashed()
        ->find($id);
        $model->update(['active' =>  true]);
        $model->restore();
    }
 
}

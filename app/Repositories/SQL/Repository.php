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
        $query = $this->model->query();
        //get only active -"if it has active status"
        $query->when(collect($this->model::filters())->contains('isActive'), function ($query)  use ($active){
            $query->isActive($active);
        });
        //applying filters
        foreach($filters as $filter => $value){
            //only if the model has it in it's filters property
            collect($this->model::filters())->contains($filter) &&
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

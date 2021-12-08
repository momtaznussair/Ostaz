<?php

namespace App\Repositories\SQL;

use App\Models\UserMessages;
use App\Repositories\Contracts\UserMessagesRepositoryInterface;

class  UserMessagesRepository extends Repository implements UserMessagesRepositoryInterface{

    public function __construct(UserMessages $message)
    {
        Parent::__construct($message);
    }

    public function getAll($active = true, $filters = [], $paginate = 15){
        $query = $this->model->query();
        //applying filters if exists
        foreach($filters as $filter => $value){
            $query->{$filter}($value);
        }
        return $query->paginate($paginate);
    }
}
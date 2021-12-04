<?php

namespace App\Repositories;

use App\Contracts\UserMessagesRepositoryInterface;
use App\Models\UserMessages;

class  UserMessagesRepository implements UserMessagesRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, $type = 'Contact'){
       return  UserMessages::
       search('message', $search)
       ->isTrashed($trashed)
       ->where('type', $type)
       ->paginate();
    }


    public function getById($id){
      # code
    }

    public function add($data){
        # code...
    }

    public function update($id, $data){
        # code...
    }

    public function remove($message){
      return UserMessages::find($message)->delete();
    }

    public function restore($message){
        return UserMessages::withTrashed()->find($message)->restore();
    }

    public function toggleActive($id, bool $active){
        # code...
    }
}
<?php

namespace App\Repositories;

use App\Contracts\UserMessagesRepositoryInterface;
use App\Models\UserMessages;

class  UserMessagesRepository implements UserMessagesRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, $type)
    {
       return  UserMessages::
       search('message', $search)
       ->isTrashed($trashed)
       ->where('type', $type)
       ->paginate();
    }


    public function remove($message)
    {
      return UserMessages::find($message)->delete();
    }

    public function restore($message)
    {
        return UserMessages::withTrashed()->find($message)->restore();
    }
}
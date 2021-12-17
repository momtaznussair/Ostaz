<?php

namespace App\Repositories\SQL;

use App\Models\UserMessages;
use App\Repositories\Contracts\UserMessagesRepositoryInterface;

class  UserMessagesRepository extends Repository implements UserMessagesRepositoryInterface{

    public function __construct(UserMessages $message)
    {
        Parent::__construct($message);
    }
}
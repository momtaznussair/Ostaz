<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class EmailOrPhone implements Rule
{
    
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return ! Validator::make([$attribute => $value], [$attribute => 'email'])->fails() ||
    
        !Validator::make([$attribute => $value], [$attribute => 'numeric|digits:11'])->fails();
    }

    public function message()
    {
        return ':attribute must be a valid email or phone number';
    }
}

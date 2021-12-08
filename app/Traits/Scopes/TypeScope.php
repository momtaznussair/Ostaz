<?php

namespace App\Traits\Scopes;

trait TypeScope {
    
    public function ScopeType($query, $type)
    {
        return $query->when($type, function ($query) use ($type){
            return $query->where('type', $type);
        });
    }
}

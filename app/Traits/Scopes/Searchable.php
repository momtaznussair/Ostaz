<?php

namespace App\Traits\Scopes;

trait Searchable {
    
    public function scopeSearch($query, String $field = 'name', String $keyword)
    {
        return $query->where($field, 'LIKE', "%$keyword%");
    }
}

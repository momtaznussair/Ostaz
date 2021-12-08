<?php

namespace App\Traits\Scopes;

trait Searchable {
    
    public function scopeSearch($query, String $keyword)
    {
        return $query->where('name', 'LIKE', "%$keyword%");
    }
}

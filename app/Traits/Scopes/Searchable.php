<?php

namespace App\Traits\Scopes;

trait Searchable {
    
    /**
     * Scope a query search a model by a certain field.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, String $field = 'name', String $keyword)
    {
        return $query->where($field, 'LIKE', "%$keyword%");
    }
}

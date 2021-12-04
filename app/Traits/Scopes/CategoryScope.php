<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CategoryScope {
    
    public function ScopeCategory($query, $category)
    {
       return $query->when($category, function($query) use ($category){
            $query->where('category_id', $category);
       });
    }
}

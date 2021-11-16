<?php

namespace App\Traits\Scopes;

trait ActiveScope {
    
    public function scopeIsActive($query, bool $active)
    {
        return $query->where('active', $active);
    }
}

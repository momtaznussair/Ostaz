<?php

namespace App\Traits\Scopes;

trait IsTrashed {
    
    public function scopeIsTrashed($query, bool $trashed)
    {
        if($trashed) return $query->onlyTrashed();
    }
}

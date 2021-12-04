<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use HaydenPierce\ClassFinder\ClassFinder;

class GetModels {

    public function __invoke()
    {
        $classes = ClassFinder::getClassesInNamespace('App\Models');
        return collect($classes)->map(function ($class){
           return Str::afterLast($class, '\\');
        });
    }
}
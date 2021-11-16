<?php

namespace App\Repositories;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface{

    public function getAll(string $keyword = '')
    {
       return  Course::search('name', $keyword)->paginate();
    }

    public function getById($id){
        # code...
    }

    public function add($course)
    {
        return $course->save();
    }

    public function update($id, $course)
    {
       return $course->save();
    }

    public function toggleActive($Course, bool $active){
        return $Course->update(['active' => !$active]);
    }
    
    public function remove($Course)
    {
      return $Course->delete();
    }

    public function getTrashed(string $keyword = '')
    {
        return  Course::search('name', $keyword)->onlyTrashed()->paginate();
    }

    public function restore($Course)
    {
        return Course::withTrashed()->find($Course)->restore();
    }
}
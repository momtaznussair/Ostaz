<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Contracts\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true, $category = null)
    {
       return  Course::with(['category', 'instructor'])
       ->withCount('student')
       ->search('name', $search)
       ->category($category)
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate();
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

    public function assignToInstructor($instructor, $attributes)
    {
        return $instructor->courses()->create($attributes);
    }

    public function assignToStudent($student, $attributes)
    {
        $student->studentCourses()->attach($attributes['course']);
        return true;
    }

    public function toggleActive($Course, bool $active){
        return $Course->update(['active' => !$active]);
    }
    
    public function remove($Course)
    {
      return $Course->delete();
    }

    public function restore($Course)
    {
        return Course::withTrashed()->find($Course)->restore();
    }
}
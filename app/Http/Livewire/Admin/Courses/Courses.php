<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Course;
use Livewire\Component;
use App\Models\Category;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

class Courses extends Component
{
    public $search = '';
    public $course, $name, $updateMode;
    public function render(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $category)
    {
        return view('livewire.admin.courses.courses', [
            'courses' => $courseRepository->getAll($this->search),
            'categories' => $category->getAll()->pluck('name', 'id')
        ]);
    }

    public function mount()
    {
        $this->course = new Course();
    }


    public function rules()
    {
      $ruls = [
            'course.name' => 'required|string|unique:courses,name',
            'course.category_id' => 'required|exists:categories,id'
       ];

       if($this->updateMode){
            $ruls['course.name'] = 'required|string|unique:courses,name,' . $this->course->id;
       }
       return $ruls;
    }

    public function selectcourse(Course $course)
    {
       $this->resetValidation();
       $this->course = $course;
       $this->name = $course->name;
    }

    public function save(CourseRepositoryInterface $courseRepository)
    {
        $this->updateMode = false;
        $this->validate();
        $courseRepository->add($this->course) && 
        $this->emit('success', __('Created Successfully!'));
        $this->course = new Course();
    }

    public function update(CourseRepositoryInterface $courseRepository)
    {
       $this->updateMode = true;
       $this->validate();
       $courseRepository->update($this->course->id, $this->course) && 
        $this->emit('success', __('Changes Saved!'));
        $this->course = new Course();
    }

    public function delete(CourseRepositoryInterface $courseRepository)
    {
        $courseRepository->remove($this->course) &&
        $this->emit('success', __('Deleted successfully!'));
    }

    public function toggleActive(Bool $active, CourseRepositoryInterface $courseRepository)
    {
        $courseRepository->toggleActive($this->course, $active) && 
        $this->emit('success', __('Changes Saved!'));
    }

}

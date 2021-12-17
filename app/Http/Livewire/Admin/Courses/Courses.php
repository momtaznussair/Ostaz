<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class Courses extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $search = '', $trashed = false, $active = true;
    public $course, $name, $updateMode;
    
    public function render(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $category, UserRepositoryInterface $userRepository)
    {
        $this->authorize('Course_access');
        return view('livewire.admin.courses.courses', [
            'courses' => $courseRepository
            ->getAll($this->active, ['isTrashed' => $this->trashed, 'Search' => $this->search, 'withCount' => 'student', 'with' => ['instructor', 'category']]),
            'categories' => $category->getAll()->pluck('name', 'id'),
            'instructors' => $userRepository->getAll(true, ['type' => 'Instructor'])->pluck('name', 'id')
        ]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount()
    {
        $this->course = new Course();
    }


    public function rules()
    {
      $ruls = [
            'course.name' => 'required|string|unique:courses,name',
            'course.category_id' => 'required|exists:categories,id',
            'course.instructor_id' => 'required|exists:users,id',
       ];

       if($this->updateMode){
            $ruls['course.name'] = 'required|string|unique:courses,name,' . $this->course->id;
       }
       return $ruls;
    }

    public function select(Course $course)
    {
       $this->resetValidation();
       $this->course = $course;
       $this->name = $course->name;
    }

    public function save(CourseRepositoryInterface $courseRepository)
    {
        $this->authorize('Course_create');
        $this->updateMode = false;
        $this->validate();
        $courseRepository->add($this->course->toArray()) && 
        $this->emit('success', __('Created Successfully!'));
        $this->course = new Course();
    }

    public function update(CourseRepositoryInterface $courseRepository)
    {
       $this->authorize('Course_edit');
       $this->updateMode = true;
       $this->validate();
       $courseRepository->update($this->course->id, $this->course->toArray()) && 
        $this->emit('success', __('Changes Saved!'));
        $this->course = new Course();
    }

    public function delete(CourseRepositoryInterface $courseRepository)
    {
        $this->authorize('Course_delete');
        $courseRepository->remove($this->course->id) &&
        $this->emit('success', __('Deleted successfully!'));
    }

    public function toggleActive(Bool $active, CourseRepositoryInterface $courseRepository)
    {
       $this->authorize('Course_edit');
        $courseRepository->toggleActive($this->course->id, $active) && 
        $this->emit('success', __('Changes Saved!'));
    }

    public function restore($course, CourseRepositoryInterface $courseRepository)
    {
        $this->authorize('Course_delete');
        $courseRepository->restore($course) &&
        $this->emit('success', __('Item restored!'));
    }

}

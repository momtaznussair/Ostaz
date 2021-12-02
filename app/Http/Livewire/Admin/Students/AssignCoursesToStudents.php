<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\User;
use Livewire\Component;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

class AssignCoursesToStudents extends Component
{
    public User $user;
    public $category, $course;
    public $courses = [];
public bool $notInReports = true;

    protected $listeners = ['userSelected'];
    public function render(CategoryRepositoryInterface $categoryRepository, CourseRepositoryInterface $courseRepository)
    {
        return view('livewire.admin.students.assign-courses-to-students', [
            'categories' => $categoryRepository->getAll()->pluck('name', 'id'),
        ]);
    }

    public function userSelected(User $user)
    {
        $this->user = $user;
    }

    public function getCourses(CategoryRepositoryInterface $categoryRepository)
    {
        $this->courses = $categoryRepository->getCourses($this->category)
        ->except($this->user->studentCourses()->pluck('id'));
    }

    protected $rules = [
        'course' => 'required|exists:courses,id',
        'category' => 'required|exists:categories,id'
    ];

    public function submit(CourseRepositoryInterface $courseRepository)
    {
        if(!$courseRepository->assignToStudent($this->user, $this->validate())){
            return $this->emit('error', __("Unknown error, we could't Complete the Operation!"));
        }

        $this->emit('success', __('Created Successfully!'));
        $this->emitUp('usersUpdated');
        $this->reset('course', 'category', 'courses');
    }
}

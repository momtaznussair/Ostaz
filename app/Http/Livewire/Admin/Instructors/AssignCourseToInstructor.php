<?php

namespace App\Http\Livewire\Admin\Instructors;

use App\Models\User;
use Livewire\Component;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;

class AssignCourseToInstructor extends Component
{
    public User $user;
    public $name, $category_id;

    protected $listeners = ['userSelected'];

    public function render(CategoryRepositoryInterface $category)
    {
        return view('livewire.admin.instructors.assign-course-to-instructor', [
            'categories' => $category->getAll()->pluck('name', 'id')
        ]);
    }

    public function userSelected(User $user)
    {
        $this->user = $user;
    }

    protected $rules = [
        'name' => 'required|string|max:255|unique:courses,name',
        'category_id' => 'required|exists:categories,id'
    ];

    public function submit(CourseRepositoryInterface $courseRepository)
    {
        if(!$courseRepository->assignToInstructor($this->user, $this->validate())){
            return $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
        }
        $this->emit('success', __('Created Successfully!'));
        $this->emitUp('usersUpdated');
        $this->reset('name', 'category_id');
    }
}

<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Contracts\CourseRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Trashed extends Component
{
    use WithPagination;

    public $search = '';
    public function render(CourseRepositoryInterface $courseRepository)
    {
        return view('livewire.admin.courses.trashed',[
            'courses' => $courseRepository->getTrashed($this->search)
        ]);
    }


    public function restore($course, CourseRepositoryInterface $courseRepository)
    {
        $courseRepository->restore($course) &&
        $this->emit('success', __('Item restored!'));
    }
}

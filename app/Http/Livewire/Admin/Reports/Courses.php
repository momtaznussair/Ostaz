<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Contracts\CourseRepositoryInterface;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Courses extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $search = '', $category;
    public function render(CourseRepositoryInterface $courseRepository, CategoryRepository $categoryRepository)
    {
        $this->authorize('Course_report_view');
        return view('livewire.admin.reports.courses', [
            'courses' => $courseRepository->getAll($this->search, false, true, $this->category),
            'categories' => $categoryRepository->getAll()
        ]);
    }
}

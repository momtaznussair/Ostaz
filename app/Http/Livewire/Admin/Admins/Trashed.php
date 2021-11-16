<?php

namespace App\Http\Livewire\Admin\Admins;

use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\CategoryRepositoryInterface;

class Trashed extends Component
{
    use WithPagination;
    public $search = '';

    public function render(CategoryRepositoryInterface $category)
    {
        dd($category->getTrashed($this->search));
        return view('livewire.admin.admins.trashed', [
            'categories' => $category->getTrashed($this->search)
        ]);
    }
}

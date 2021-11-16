<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use App\Contracts\CategoryRepositoryInterface;

class Trashed extends Component
{
    public $search = '';

    public function render(CategoryRepositoryInterface $category)
    {
        return view('livewire.admin.categories.trashed', [
            'categories' => $category->getTrashed($this->search)
        ]);
    }

    public function restore($category, CategoryRepositoryInterface $categoryRepository)
    {
        $categoryRepository->restore($category) &&
        $this->emit('success', __('Item restored!'));
    }
}

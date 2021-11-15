<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\Types\Boolean;

class Categories extends Component
{
    use WithPagination;
    public $name;
    public $search = '';
    public Category $category;
    
    public function render(CategoryRepositoryInterface $category)
    {
        return view('livewire.admin.categories.categories', [
            'categories' => $category->getAll($this->search)
        ]);
    }

    protected function rules()
    {
        return [ 'name' => 'required|unique:categories,name'];
    }

    public function selectCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function save(CategoryRepositoryInterface $categoryRepository)
    {
       $categoryRepository->add($this->validate()) && 
       $this->reset('name');
       $this->emit('success', __('Created Successfully!'));
    }

    public function update(CategoryRepositoryInterface $categoryRepository)
    {
        $validName = $this->validate([ 'name' => 'required|unique:categories,name,' . $this->category->id]);
        $categoryRepository->update($this->category->id, $validName) && 
        $this->emit('success', __('Changes Saved!'));
        $this->reset('name');
    }

    public function delete(CategoryRepositoryInterface $categoryRepository)
    {
        $categoryRepository->remove($this->category) &&
        $this->emit('success', __('Deleted successfully!'));
        $this->reset('name');
    }

    public function toggleActive(Bool $active, CategoryRepositoryInterface $categoryRepository)
    {
       $categoryRepository->toggleActive($this->category, $active) && 
       $this->emit('success', __('Changes Saved!'));
    }
}

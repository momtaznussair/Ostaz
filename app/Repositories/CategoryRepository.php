<?php

namespace App\Repositories;

use App\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface{

    public function getAll(string $keyword = '')
    {
       return  Category::search('name', $keyword)->paginate();
    }

    public function getById($id){
        # code...
    }

    public function add($data)
    {
        return Category::create($data);
    }

    public function update($id, $data)
    {
       return Category::find($id)->update($data);
    }

    public function toggleActive($category, bool $active){
        return $category->update(['active' => !$active]);
    }
    public function remove($category)
    {
      return $category->delete();
    }

    public function getTrashed(string $keyword = '')
    {
        return  Category::search('name', $keyword)->onlyTrashed()->paginate();
    }

    public function restore($category)
    {
        return Category::withTrashed()->find($category)->restore();
    }
}
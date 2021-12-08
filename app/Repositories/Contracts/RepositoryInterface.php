<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface{
    public function getAll($active = true, $filters = [], $paginate = 15);
    public function getById($id);
    public function add($attributes);
    public function update($id, $attributes);
    public function remove($id);
    public function restore($id);
    public function toggleActive($id, bool $active);
}
<?php

namespace App\Contracts;

interface RepositoryInterface{

    public function getAll(string $search = '', bool $trahsed = false, bool $active = true);
    public function getById($id);
    public function add($data);
    public function update($id, $data);
    public function remove($id);
    public function restore($id);
}
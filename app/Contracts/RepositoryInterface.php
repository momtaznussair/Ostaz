<?php

namespace App\Contracts;

interface RepositoryInterface{

    public function getAll(string $keyword = '');
    public function getById($id);
    public function add($data);
    public function update($id, $data);
    public function remove($id);
    public function getTrashed();
    public function restore($id);
}
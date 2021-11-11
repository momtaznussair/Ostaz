<?php

namespace App\Contracts;

interface RepositoryInterface{

    public function getAll();
    public function getById($id);
    public function add($data);
    public function update($id, $data);
    public function remove($id);
}
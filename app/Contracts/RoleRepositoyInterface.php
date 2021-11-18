<?php

namespace App\Contracts;

interface RoleRepositoyInterface{
    // Role Specific Methods
    public function getAll();
    public function add($data);
    public function update($id, $data);
    public function remove($id);
    public function restore($id);
}
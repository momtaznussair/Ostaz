<?php

namespace App\Contracts;

interface UserMessagesRepositoryInterface{

    /**
     * get all messages
     * @param type contact or opinion
     */
    public function getAll(string $search = '', bool $trahsed = false, $type);
    public function remove($id);
    public function restore($id);
}
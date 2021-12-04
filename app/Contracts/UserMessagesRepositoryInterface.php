<?php

namespace App\Contracts;

interface UserMessagesRepositoryInterface extends RepositoryInterface{

    /**
     * get all messages
     * @param type contact or opinion
     */
    public function getAll(string $search = '', bool $trahsed = false, $type = 'Contact');
}
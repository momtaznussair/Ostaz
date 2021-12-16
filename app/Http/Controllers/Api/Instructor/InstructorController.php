<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Api\ApiResponse;

class InstructorController extends Controller
{
    use ApiResponse;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
       $this->userRepository = $userRepository;
    }

    public function index()
    {
        $instructors = $this->userRepository->getAll(true, ['type' => 'Instructor']);
        return $this->apiResponse($instructors, 'List of instructors');
    }
}

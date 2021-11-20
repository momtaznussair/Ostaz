<?php

namespace App\Http\Livewire\Admin\Instructors;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Instructors extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $trashed = false, $active = true, $search = '';
    public $name;
    public User $user;

    protected $listeners = ['usersUpdated' => '$refresh'];

    public function render(UserRepositoryInterface $userRepository)
    {
        return view('livewire.admin.instructors.instructors', [
            'instructors' => $userRepository->getAll($this->search, $this->trashed, $this->active, 'Instructor'),
        ]);
    }

    public function select(User $user, $toUpdate = false){
        //if it's the edit button that was pressed we just send the selected Admin to the updateOrCreate Component
        if($toUpdate){ return $this->emit('userSelected', ['user' => $user]); }
        $this->user = $user;
        $this->name = $this->user->name;
    }

    public function delete(UserRepositoryInterface $userRepository){
        $this->authorize('User_delete');
        $userRepository->remove($this->user) && 
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($user, UserRepositoryInterface $userRepository){
        $this->authorize('Admin_delete');
        $userRepository->restore($user) &&
        $this->emit('success', __('Item restored!'));
    }

    public function toggleActive(Bool $active, UserRepositoryInterface $userRepository)
    {
       $this->authorize('User_edit');
       $userRepository->toggleActive($this->user, $active) && 
       $this->emit('success', __('Changes Saved!'));
    }
}


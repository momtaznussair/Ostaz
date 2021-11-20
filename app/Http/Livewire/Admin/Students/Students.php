<?php

namespace App\Http\Livewire\Admin\Students;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Students extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $trashed = false, $active = true, $search = '';
    public $name;
    public User $user;

    protected $listeners = ['usersUpdated' => '$refresh'];

    public function render(UserRepositoryInterface $userRepository)
    {
        return view('livewire.admin.students.students', [
            'students' => $userRepository->getAll($this->search, $this->trashed, $this->active, 'Student'),
        ]);
    }

    public function mount() { $this->user = new User(); }

    public function select(User $user, String $purpose = null){
        //if it's the edit button that was pressed we just send the selected Admin to the updateOrCreate Component
        if($purpose == 'toUpdate'){ return $this->emitTo('admin.users.update-or-create-user', 'userSelected', ['user' => $user]); }
        //if it's the courses button that was pressed we just send the selected Admin to the updateOrCreate Component
        if($purpose == 'toViewCourses'){ return $this->emitTo('admin.students.assign-courses-to-students', 'userSelected', ['user' => $user]); }
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

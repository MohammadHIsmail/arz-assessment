<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserView extends Component
{
    use AuthorizesRequests;

    public $user;
    public $selectedUser;

    protected $listeners = [
        'destroy',
    ];

    public function mount() 
    { 
        $this->authorize('user-list');

        $this->user = User::orderBy('id', 'desc')->get();

        $this->selectedUser = new User();
    }

    public function getSelectedUser($id)
    {
        $this->selectedUser = User::find($id);
        $this->emit('refresh');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users')
            ->with('success', 'User deleted successfully');
    }

    public function render()
    {
        return view('livewire.user-management.users.user-view');
    }
}

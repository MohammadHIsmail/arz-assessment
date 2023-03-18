<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\AuditService;

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

        $this->user = User::orderBy('id', 'asc')->get();

        $this->selectedUser = new User();
    }

    public function getSelectedUser($id)
    {
        $this->selectedUser = User::find($id);
        $this->emit('refresh');
    }

    public function destroy($id)
    {
        $oldData=[];
        $oldData['user']=User::where('id', $id)->first()->email;

        $newData=[];
        $newData['user']='';

        AuditService::AuditLog($oldData,$newData,auth()->user()->id,'user','delete');
        User::where('id', $id)->delete();

        return redirect()->route('users')
            ->with('success', 'User deleted successfully');
    }

    public function render()
    {
        return view('livewire.user-management.users.user-view');
    }
}

<?php

namespace App\Http\Livewire\UserManagement\Roles;

use DB;
use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\AuditService;

class RoleView extends Component
{
    use AuthorizesRequests;

    public $role;

    protected $listeners = [
        'destroy',
    ];

    public function mount() 
    { 
        $this->authorize('role-list');
        
        $this->role = Role::orderBy('id','ASC')->get();
    }
    
    public function destroy($id)
    {
        $oldData=[];
        $oldData['role']=Role::where('id', $id)->first()->name;

        $newData=[];
        $newData['role']='';

        AuditService::AuditLog($oldData,$newData,auth()->user()->id,'role','delete');
        Role::where('id', $id)->delete();
        
        return redirect()->route('roles')
            ->with('success', 'Role deleted successfully');
    }

    public function render()
    {
        return view('livewire.user-management.roles.role-view');
    }
}

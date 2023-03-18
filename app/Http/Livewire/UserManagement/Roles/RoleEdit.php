<?php

namespace App\Http\Livewire\UserManagement\Roles;

use Livewire\Component;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\AuditService;

class RoleEdit extends Component
{
    use AuthorizesRequests;

    public $name;
    public $role;
    public $permission;
    public $rolePermissions;
    public $selectAll = false;

    public $selectedPermission = [];
    public $filtererdPermissions = [];
    public $allpermissions = [];

    protected $rules = [
        'name' => 'required|unique:roles,name',
        'selectedPermission' => 'array'
    ];


    public function mount($id) 
    {
        $this->authorize('role-edit');

        $this->permission = Permission::get();
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        $this->rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        $this->selectedPermission = $this->rolePermissions;


        $tempobj = [];
        foreach($this->permission as $key => $p) 
        {
            $permissionName = explode("-", $p->name);
            $permHead = $permissionName[0];

            if((count($tempobj) > 0 && array_keys($tempobj)[count($tempobj)-1] != $permHead) || $key == 0)
            {
                $tempobj[$permHead] = [];
            }
            $p->permissionSubName =$permissionName[1];
            array_push($tempobj[$permHead],$p);

        }
        $this->filtererdPermissions = $tempobj;

        $this->allpermissions = DB::table('role_has_permissions')
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();
 
        if(count($this->selectedPermission) == count($this->allpermissions))
        {
            $this->selectAll = true;
        }
        
    }

    public function selectAllPermissions()
    {
        $this->selectAll = !$this->selectAll;
        if($this->selectAll)
        {
            $this->selectedPermission = $this->allpermissions;
        }
        else
        {
            $this->selectedPermission = [];
        }
    }


    public function update()
    {
        $validatedData = $this->validate([
            'name' => '',
            'selectedPermission' => 'required'
        ]);

        $oldData = [];
        $oldData['role'] = $this->role->name;
        $newData = [];
        $newData['role'] = $validatedData['name'];

 
        foreach( $this->rolePermissions as $key => $permission)
        {
            if($permission)
            {
                $p = Permission::find($permission)->name;
                $oldData[$key] =  $p;
            }
            else
            {
                $oldData[$key] = '';
            }
        }
        
        foreach($validatedData['selectedPermission'] as $key => $permission)
        {
            if($permission)
            {
                $p = Permission::find($key)->name;
                $newData[$key] =  $p;
                if(!isset($oldData[$key])){

                    $oldData[$key] = '';
                }
            }
            else
            {
                unset($validatedData['selectedPermission'][$key]);
                $newData[$key] = '';    
            }
        }

        AuditService::AuditLog($oldData,$newData,auth()->user()->id,'role','edit');

        $this->role->name = $validatedData['name'];
        $this->role->save();
    
        $this->role->syncPermissions(array_keys($validatedData['selectedPermission']));

        return redirect()->route('roles')
            ->with('success', 'Role updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-management.roles.role-edit');
    }
}
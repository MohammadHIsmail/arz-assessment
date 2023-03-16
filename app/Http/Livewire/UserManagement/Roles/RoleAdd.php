<?php

namespace App\Http\Livewire\UserManagement\Roles;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAdd extends Component
{
    use AuthorizesRequests;

    public $name;
    public $permission;
    public $role;

    public $selectAll = false;
    // public $notBooted = true;

    
    public $selectedPermission = [];

    public $filtererdPermissions = [];
    public $allpermissions = [];
    
    protected $rules = [
        'name' => 'required|unique:roles,name',
        'permission' => 'required'
    ];

    // protected $listeners = [
    //     'cardLoaded',
    // ];
 
    public function mount() 
    {
        $this->authorize('role-add');

        $this->permission = Permission::get();
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
    }

    // public function cardLoaded($isBooted)
    // {
    //     $this->notBooted = $isBooted;
    // }

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

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|unique:roles,name',
            'selectedPermission' => 'required'
        ]);

        foreach($validatedData['selectedPermission'] as $key => $value)
        {
            if($value == false)
            {
                unset($validatedData['selectedPermission'][$key]); 
            }
        }
        
        $role = Role::create(['name' => $validatedData['name']]);
        $role->syncPermissions(array_keys($validatedData['selectedPermission']));

        return redirect()->route('roles')
            ->with('success', 'Role created successfully.');
    }

    public function render()
    {
        return view('livewire.user-management.roles.role-add');
    }
}

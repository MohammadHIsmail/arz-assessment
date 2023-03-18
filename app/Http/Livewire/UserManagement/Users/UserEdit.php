<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Department;
use DB;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\AuditService;

class UserEdit extends Component
{
    use AuthorizesRequests;

    public $user;

    public $roles;
    public $selectedrole;

    public $genders;
    public $selectedgender;

    public $departments;
    public $selecteddep;

    public $currEmail;
    public $email;
    public $name;
    public $phone;
    public $password;
    public $password_confirmation;

    public function mount($id) 
    { 
        $this->authorize('user-edit');

        $this->roles = Role::pluck('name','id')->all();
        $this->genders =[1=>'Male',2=>'Female'];
        $this->departments = Department::pluck('name','id')->all();
        $this->user = User::find($id);
        $this->email = $this->user->email;
        $this->currEmail = $this->user->email;
        $this->name = $this->user->name;
        $this->phone = $this->user->phone;
        $this->selectedgender =$this->user->gender;
        $this->selectedrole = Role::where('name',$this->user->getRoleNames()[0])->first()->id;
        $this->selecteddep = Department::find($this->user->department_id)->id;
    }

    
    public function update()
    {
        if($this->currEmail != $this->email) {
            $uniqueEmail = 'required|unique:users';
        } else {
            $uniqueEmail = 'required|email';
        }
        $validatedData = $this->validate([
            'email' => $uniqueEmail,
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|required_with:password|same:password',
            'name' => 'required',
            'phone' => 'required',
            'selectedgender' => 'required',
            'selectedrole' => 'required',
            'selecteddep' => 'required',
        ]);

        $oldData = [];
        $newData = [];

        $oldData['email'] = $this->user->email;
        $oldData['name'] = $this->user->name;
        $oldData['phone'] = $this->user->phone;
        $oldData['gender'] = $this->user->gender;
        $oldData['password'] = '*****';
        $oldData['department_name'] = Department::find($this->user->department_id)->name;
        $oldData['role'] = Role::find(DB::table('model_has_roles')->where('model_id',$this->user->id)->first()->role_id)->name;
        
        
        $newData['email'] = $validatedData['email'];
        $newData['name'] = $validatedData['name'];
        $newData['phone'] = $validatedData['phone'];
        $newData['gender'] = $validatedData['selectedgender'];
        $newData['password'] = '#####';
        $newData['department_name'] = Department::find($validatedData['selecteddep'])->name;
        $newData['role'] = Role::find(DB::table('model_has_roles')->where('model_id',$validatedData['selectedrole'])->first()->role_id)->name;
        

        AuditService::AuditLog($oldData,$newData,auth()->user()->id,'user','edit');
         
        $this->user->email = $validatedData['email'];
        $this->user->name = $validatedData['name'];
        $this->user->phone = $validatedData['phone'];
        $this->user->gender = $validatedData['selectedgender'];
        $this->user->department_id = $validatedData['selecteddep'];
        $this->user->password = Hash::make($validatedData['password']);
        DB::table('model_has_roles')->where('model_id',$this->user->id)->delete();
    
        $this->user->save();
        
        $this->user->assignRole($validatedData['selectedrole']);

        return redirect()->route('users')
            ->with('success', 'User updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-management.users.user-edit');
    }
}

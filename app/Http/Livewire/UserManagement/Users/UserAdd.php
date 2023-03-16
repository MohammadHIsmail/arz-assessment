<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Department;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserAdd extends Component
{
    use AuthorizesRequests;

    public $roles;
    public $selectedrole;

    public $genders;
    public $selectedgender;

    public $departments;
    public $selecteddep;

    public $email;
    public $name;
    public $phone;
    public $password;
    public $password_confirmation;


    public function mount() { 

        $this->authorize('user-add');

        $this->genders =[1=>'Male',2=>'Female'];

        $this->roles = Role::pluck('name','id')->all();

        $this->departments = Department::pluck('name','id')->all();
        
    }

    public function store()
    {
        $validatedData = $this->validate([
            'email' => 'required|unique:users',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|required_with:password|same:password',
            'name' => 'required',
            'phone' => 'required',
            'selectedgender' => 'required',
            'selectedrole' => 'required',
            'selecteddep' => 'required',
        ]);

        $user = new User();
        $user->email = $validatedData['email'];
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'];
        $user->gender = $validatedData['selectedgender'];
        $user->department_id = $validatedData['selecteddep'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        $user->assignRole($validatedData['selectedrole']);
    
        return redirect()->route('users')
            ->with('success', 'User created successfully.');
    }

    public function render()
    {
        return view('livewire.user-management.users.user-add');
    }
}

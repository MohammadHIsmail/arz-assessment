<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserAdd extends Component
{
    use AuthorizesRequests;

    public $roles;
    public $selectedrole;

    public $userId;
    public $password;
    public $password_confirmation;


    public function mount() { 

        $this->authorize('user-add');

        $this->roles = Role::pluck('name','id')->all();
        
    }

    public function store()
    {
        $validatedData = $this->validate([
            'userId' => 'required|unique:users',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|required_with:password|same:password',
            'selectedrole' => 'required',
        ]);

        $user = new User();
        $user->userId = $validatedData['userId'];
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

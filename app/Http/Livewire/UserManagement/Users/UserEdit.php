<?php

namespace App\Http\Livewire\UserManagement\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserEdit extends Component
{
    use AuthorizesRequests;

    public $user;
    public $roles;
    public $selectedrole;


    public $userId;
    public $password;
    public $password_confirmation;

    // public $notBooted = true;


    // protected $listeners = [
    //     'cardLoaded',
    // ];

    // public function cardLoaded($isBooted)
    // {
    //     $this->notBooted = $isBooted;
    // }
    

    public function mount($id) 
    { 
        $this->authorize('user-edit');

        $this->roles = Role::pluck('name','id')->all();
        $this->user = User::find($id);
        $this->userId = $this->user->userId;;
        $this->selectedrole = Role::where('name',$this->user->getRoleNames()[0])->first()->id;
    }

    
    public function update()
    {
        $validatedData = $this->validate([
            'userId' => 'required|unique:userId',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|required_with:password|same:password',
            'selectedrole' => 'required',
        ]);
         
        $this->user->userId = $validatedData['userId'];
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

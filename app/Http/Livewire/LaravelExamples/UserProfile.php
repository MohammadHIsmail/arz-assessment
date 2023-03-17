<?php

namespace App\Http\Livewire\LaravelExamples;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Department;
use App\Services\AuditService;


use Livewire\Component;

class UserProfile extends Component
{
    use AuthorizesRequests;
    public $user;
    public $showSuccesNotification  = false;

    public $department;
    public $genders;
    public $selectedgender;

    public $currEmail;
    public $email;
    public $name;
    public $phone;
    public $password;
    public $password_confirmation;
    
    public function mount() { 
        $this->authorize('user-profile');
        $this->genders =[1=>'Male',2=>'Female'];
        $this->user = auth()->user();
        $this->email = $this->user->email;
        $this->currEmail = $this->user->email;
        $this->name = $this->user->name;
        $this->phone = $this->user->phone;
        $this->selectedgender =$this->user->gender;
        if($this->user->hasRole('Admin')){
            $this->department="ADMIN";
        }else{
            $this->department = Department::find($this->user->department_id)->name;
        }
    }

    public function save() {
        
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
        ]);

        $oldData = [];
        $newData = [];

        $oldData['email'] = $this->user->email;
        $oldData['name'] = $this->user->name;
        $oldData['phone'] = $this->user->phone;
        $oldData['gender'] = $this->user->gender;
        
        $newData['email'] = $validatedData['email'];
        $newData['name'] = $validatedData['name'];
        $newData['phone'] = $validatedData['phone'];
        $newData['gender'] = $validatedData['selectedgender'];

        AuditService::AuditLog($oldData,$newData,auth()->user()->id,'user','edit');
         
        $this->user->email = $validatedData['email'];
        $this->user->name = $validatedData['name'];
        $this->user->phone = $validatedData['phone'];
        $this->user->gender = $validatedData['selectedgender'];
        $this->user->password = Hash::make($validatedData['password']);
        $this->user->save();
        $this->showSuccesNotification = true;
        $this->password = '';
        $this->password_confirmation = '';
    }
    public function render()
    {
        return view('livewire.laravel-examples.user-profile');
    }
}

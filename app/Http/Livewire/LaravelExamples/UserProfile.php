<?php

namespace App\Http\Livewire\LaravelExamples;
use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Livewire\Component;

class UserProfile extends Component
{
    use AuthorizesRequests;
    public User $user;
    public $showSuccesNotification  = false;

    public $password;
    public $password_confirmation;
    
    public function mount() { 
        $this->authorize('user-profile');

        $this->user = auth()->user();
    }

    public function save() {
        
        $validatedData = $this->validate([
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|required_with:password|same:password',
        ]);

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

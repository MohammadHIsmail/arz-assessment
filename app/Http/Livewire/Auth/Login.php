<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\LeadershipInfo;

class Login extends Component
{
    public $email = '';
    public $password = '';


    public function mount() {
        if(auth()->user()){
            redirect('/dashboard');
        }
    }

    public function login() {

        $validatedData = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(auth()->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $user = User::where(["email" => $validatedData['email']])->first();
            auth()->login($user);
            return redirect()->intended('/dashboard');        
        }
        else{
            return $this->addError('email', "Wrong credentials"); 
        }
        
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

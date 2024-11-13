<?php

namespace App\Livewire;

use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Login extends Component
{
    public string $email, $password;

    public function render()
    {
        return view('components.login');
    }

    public function authTaken(): bool|Redirector
    {
        $validatedDate = $this->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => 'required',
        ]);
        if(!Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            ResponseService::flash("user not found");
            return false;
        }
        if(!Auth::user()->role == "admin"){
            ResponseService::flash("access denied");
            Auth::logout();
            return false;
        }
        $this->dispatch('navigateToPage', [
            "url" => url('admin')
        ]);
        return true;
    }

}

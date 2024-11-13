<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    public string $name, $email, $password, $c_password;
    public ?array $roles = [];
    public Collection $allRoles;

    public function render()
    {
        $this->allRoles = Role::all();
        return view('components.addUser');
    }

    public function add()
    {
        $validatedDate = $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
            'c_password' => ['required', 'same:password'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'exists:roles,id']
        ]);
        
        $user = User::create($validatedDate);
        $user->syncRoles(Role::whereIn('id', $this->roles)->get()->pluck('name')->toArray());
        if (!$user->hasRole('admin')) {
            //update user role
            $user->update(['role' => 'user']);
        }
        $this->resetForm();
        ResponseService::flash("added successfully", "message");
    }

    //need reset the form after adding the user
    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->c_password = '';
        $this->roles = [];
    }

}
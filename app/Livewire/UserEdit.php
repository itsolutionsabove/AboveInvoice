<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public ?string $name, $email, $password = null, $c_password = null, $id = null , $role = null;
    public ?User $user = null;
    public ?array $roles = [];
    public Collection $allRoles;

    public function render()
    {
        if(!$this->user){
            $this->id = $this->id ?? request()?->id;
            $this->user = User::findOrFail($this->id);
            $this->allRoles = Role::all();
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->roles = $this->user->roles?->pluck('id')?->toArray() ?? [];
            $this->role = $this->user->role;
        }
        // dd($this->roles);
        return view('components.editUser');
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required'],
            'email' => Rule::unique('users', 'email')->ignore($this->id),
            'password' => 'sometimes',
            'c_password' => ['same:password'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'exists:roles,id']
        ]);
        $update = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        if($this->password) $update['password'] = $this->password;
        $this->user->update($update);
        
        $this->user->syncRoles(Role::whereIn('id', $this->roles)->get()->pluck('name')->toArray());
        if ($this->user->hasRole('admin')) {
            //update user role
            $this->user->update(['role' => 'admin']);
        }else{
            $this->user->update(['role' => 'user']);
        }
        ResponseService::flash("updated successfully", "message");
    }

}

<?php

namespace App\Livewire;

use App\AppInfo;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{

    public ?string $name, $id;
    public array $permissions = [];
    public Collection $allPermissions;
    public ?Role $role;
    public bool $selectAllItems = false;

    public function render()
    {
        $this->id = $this->id ?? request()?->id;
        $this->role = Role::findOrFail($this->id);
        $this->allPermissions = $this->allPermissions ?? Permission::all();
        $this->name = $this->role->name;
        $this->permissions = $this->role->permissions()->pluck('name')->toArray();
        return view('components.editRole');
    }

    public function selectAll(){
        if(!$this->selectAllItems){
            $this->permissions = [];
        }else{
            $this->permissions = $this->allPermissions->pluck('name')->toArray();
        }
    }

    public function edit()
    {
        $this->validate([
            'name' => ['required', Rule::unique('roles', 'name')->ignore($this->role->id)],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['required', 'in:' . implode(",", AppInfo::permissions())],
        ]);
        $this->role->update([
            'name' => $this->name,
        ]);
        $this->role->syncPermissions($this->permissions);
        ResponseService::flash("updated successfully", "message");
    }

}

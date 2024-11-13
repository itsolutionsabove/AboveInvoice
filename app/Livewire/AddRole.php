<?php

namespace App\Livewire;

use App\AppInfo;
use App\Services\Response\ResponseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRole extends Component
{
    public string $name;
    public array $permissions = [];
    public Collection $allPermissions;
    public bool $selectAllItems = false;

    public function render()
    {
        $this->allPermissions = $this->allPermissions ?? Permission::all();
        return view('components.addRole');
    }

    public function add()
    {
        $validatedDate = $this->validate([
            'name' => ['required', 'unique:roles'],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['required', 'in:' . implode(",", AppInfo::permissions())],
        ]);
        $role = Role::create([
            'name' => $this->name,
        ]);
        $role->syncPermissions($this->permissions);
        ResponseService::flash("added successfully", "message");
    }

    public function selectAll(){
        if(!$this->selectAllItems){
            $this->permissions = [];
        }else{
            $this->permissions = $this->allPermissions->pluck('name')->toArray();
        }
    }

}

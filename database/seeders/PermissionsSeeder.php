<?php

namespace Database\Seeders;

use App\AppInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (AppInfo::permissions() as $permission) Permission::create(['name' => $permission]);

        //create role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(AppInfo::permissions());
         
    }
}
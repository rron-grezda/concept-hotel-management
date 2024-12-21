<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach($roles as $role){
            switch($role->name){
                case 'admin':
                    $permissions = Permission::all();
                    foreach($permissions as $permission){
                        $role->givePermissionTo($permission);
                    }
                    break;
                case 'hotel-owner':
                    $permissions = Permission::where('name', 'like', '% hotel')->orWhere('name', 'like', '% room')->get();
                    foreach($permissions as $permission){
                        $role->givePermissionTo($permission);
                    }
                    break;
                case 'client':
                    $role->syncPermissions(['review hotel', 'book room']);
                    break;
            }
        }
    }   
}

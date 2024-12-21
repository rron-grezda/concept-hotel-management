<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions =['list', 'show', 'create', 'store', 'edit', 'update', 'delete'];
        $models = ['hotel', 'room', 'user'];

        foreach($actions as $action){
            foreach($models as $model){
                Permission::create(['name' => $action . ' ' . $model, 'guard_name' => 'web']);
            }
        }

        //other permissions
        Permission::create(['name' => 'review hotel', 'guard_name' => 'web']);
        Permission::create(['name' => 'book room', 'guard_name' => 'web']);
    }
}

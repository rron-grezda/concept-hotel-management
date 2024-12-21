<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =['admin', 'hotel-owner', 'client'];

        foreach($roles as $role){
            Role::create(['name' => $role, 'guard_name' => 'web']);
        }
    }
}

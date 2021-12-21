<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'user.list','module_name' => 'user']);
        Permission::create(['name' => 'user.create','module_name' => 'user']);
        Permission::create(['name' => 'user.store','module_name' => 'user']);
        Permission::create(['name' => 'user.edit','module_name' => 'user']);
        Permission::create(['name' => 'user.update','module_name' => 'user']);
        Permission::create(['name' => 'user.delete','module_name' => 'user']);
        Permission::create(['name' => 'user.update-password','module_name' => 'user']);

        Permission::create(['name' => 'permission.list','module_name' => 'permission']);
        Permission::create(['name' => 'permission.create','module_name' => 'permission']);
        Permission::create(['name' => 'permission.store','module_name' => 'permission']);
        Permission::create(['name' => 'permission.edit','module_name' => 'permission']);
        Permission::create(['name' => 'permission.update','module_name' => 'permission']);
        Permission::create(['name' => 'permission.delete','module_name' => 'permission']);

        Permission::create(['name' => 'role.list','module_name' => 'role']);
        Permission::create(['name' => 'role.create','module_name' => 'role']);
        Permission::create(['name' => 'role.store','module_name' => 'role']);
        Permission::create(['name' => 'role.edit','module_name' => 'role']);
        Permission::create(['name' => 'role.update','module_name' => 'role']);
        Permission::create(['name' => 'role.delete','module_name' => 'role']);
    }
}

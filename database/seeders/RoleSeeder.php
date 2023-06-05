<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        $role = Role::create([
            'name' => 'author',
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo(['create articles']);

        $role = Role::create([
            'name' => 'editor',
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo(['edit articles']);

        $role = Role::create([
            'name' => 'moderator',
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo(Permission::all());
    }
}

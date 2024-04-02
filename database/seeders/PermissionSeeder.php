<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'create',
            'read',
            'update',
            'delete',
        ];

        $modules = [
            'users',
            'roles',
            'permissions',
        ];

        $roles = [
            'super-admin' => 'Super Admin',
            'admin' => 'Admin',
            'user' => 'Usuário',
        ];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$module.$action",
                ]);
            }
        }
        
        foreach ($roles AS $role => $roleName) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);

            if($role === 'super-admin') {
                $role = Role::findByName('super-admin');
                $role->givePermissionTo(Permission::all());                
            }

            if($role === 'admin') {
                $role = Role::findByName('admin');
                $modulesAdmin = collect($modules)->map(function ($module) {
                    return !in_array($module, ['users']) ? $module : null;
                })->filter();

                foreach ($modulesAdmin as $module) {
                    foreach ($actions as $action) {
                        $role->givePermissionTo("$module.$action");
                    }
                }
            }
        }
    }
}

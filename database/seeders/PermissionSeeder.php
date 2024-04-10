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
       
        try {
            DB::beginTransaction();
                $admin = Role::create(['name' => 'admin']);
                $collaborator = Role::create(['name' => 'collaborator']);
                $user = Role::create(['name' => 'user']);
                $superAdmin = Role::create(['name' => 'super-admin']);

                $permissions = [
                    'users' => ['create', 'read', 'update', 'delete'],
                    'roles' => ['create', 'read', 'update', 'delete'],
                    'permissions' => ['create', 'read', 'update', 'delete'],
                    'plans' => ['create', 'read', 'update', 'delete'],
                    'subscriptions' => ['create', 'read', 'update', 'delete'],
                    'address' => ['create', 'read', 'update', 'delete'],
                    'address' => ['create', 'read', 'update', 'delete'],
                ];

                foreach ($permissions as $resource => $actions) {
                    foreach ($actions as $action) {
                        Permission::firstOrCreate([
                            'name' => "$resource.$action",
                        ]);
                    }
                }

                $admin->givePermissionTo(Permission::all());
                $superAdmin->givePermissionTo(Permission::all());
                $collaborator->givePermissionTo([
                    'users.read',
                    'users.update',
                    'roles.read',
                    'roles.update',
                    'permissions.read',
                    'permissions.update',
                    'plans.read',
                    'plans.update',
                    'subscriptions.read',
                    'subscriptions.update',
                    'address.read',
                    'address.update',
                ]);
                $user->givePermissionTo([
                    'users.update',
                    'address.read',
                    'address.create',
                    'address.update',
                    'address.delete',
                ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}

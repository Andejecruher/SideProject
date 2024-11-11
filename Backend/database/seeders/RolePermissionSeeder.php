<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Lista de permisos
        $permissions = [
            'images.index',
            'images.show',
            'images.create',
            'images.edit',
            'images.destroy',
            'articles.index',
            'articles.show',
            'articles.create',
            'articles.edit',
            'articles.destroy',
            'articles.published',
            'categories.index',
            'categories.show',
            'categories.create',
            'categories.edit',
            'categories.destroy',
            'tags.index',
            'tags.show',
            'tags.create',
            'tags.edit',
            'tags.destroy',
            'comments.index',
            'comments.show',
            'comments.create',
            'comments.edit',
            'comments.destroy',
            'comments.approved',
            'users.index',
            'users.show',
            'users.create',
            'users.edit',
            'users.destroy',
            'roles.index',
            'roles.show',
            'roles.create',
            'roles.edit',
            'roles.destroy',
            'permissions.index',
            'permissions.show',
            'permissions.create',
            'permissions.edit',
            'permissions.destroy',
            'dashboard.index',
            'dashboard.show',
            'dashboard.create',
            'dashboard.edit',
            'dashboard.destroy',
        ];

        // Crear permisos y asignar al rol de Admin
        foreach ($permissions as $permissionName) {
            if (preg_match('/^([a-zA-Z0-9_]+)/', $permissionName, $matches)) {
                $group = strtolower($matches[1]); // Extrae la primera palabra y la convierte a minúsculas
            }
            $permission = Permission::firstOrCreate(['name' => $permissionName, 'group' => $group]);
            $adminRole->givePermissionTo($permission); // Asignar todos los permisos al rol Admin
        }

        // Permisos específicos para el rol de User
        $userPermissions = [
            'images.index',
            'images.show',
            'images.create',
            'images.edit',
            'articles.index',
            'articles.show',
            'articles.create',
            'articles.edit',
            'categories.index',
            'categories.show',
            'categories.create',
            'categories.edit',
            'tags.index',
            'tags.show',
            'tags.create',
            'tags.edit',
            'comments.index',
            'comments.show',
            'comments.create',
            'comments.edit',
            'dashboard.index',
            'dashboard.show',
            'dashboard.create',
            'dashboard.edit',
        ];

        foreach ($userPermissions as $permissionName) {
            if (preg_match('/^([a-zA-Z0-9_]+)/', $permissionName, $matches)) {
                $group = strtolower($matches[1]); // Extrae la primera palabra y la convierte a minúsculas
            }
            $userPermissions = Permission::firstOrCreate(['name' => $permissionName, 'group' => $group]);
            $userRole->givePermissionTo($userPermissions); // Asignar todos los permisos al rol Admin
        }

        // Asignar roles a toos los usuarios
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $users = User::all();
        foreach ($users as $user) {
            if ($user->role == 'admin') {
                $user->assignRole($adminRole);
            }

            if ($user->role == 'user') {
                $user->assignRole($userRole);
            }
        }

        // Mensaje de confirmación
        $this->command->info('Roles y permisos generados correctamente.');
    }
}

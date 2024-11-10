<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Ejecutar el comando para generar permisos automáticamente
        Artisan::call('permissions:generate');
        $this->command->info('Permisos generados automáticamente.');

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Lista de permisos
        $permissions = [
            'images.show',
            'articles.index',
            'articles.show',
            'articles.create',
            'articles.store',
            'articles.edit',
            'articles.update',
            'articles.destroy',
            'categories.index',
            'categories.create',
            'categories.store',
            'categories.edit',
            'categories.update',
            'categories.destroy',
            'tags.index',
            'comments.index',
            'comments.store',
            'comments.show',
            'comments.update',
            'comments.destroy',
            'login',
            'forgot-password',
            'reset-password',
            'logout',
            'upload.image',
            'profile',
            'users-list',
            'categories-list',
            'articles-list',
            'tags-list',
            'comments-list',
            'dashboard',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
            'users.destroy'
        ];

        // Crear permisos y asignar al rol de Admin
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $adminRole->givePermissionTo($permission); // Asignar todos los permisos al rol Admin
        }

        // Permisos específicos para el rol de User
        $userPermissions = [
            'articles.index',
            'articles.show',
            'categories.index',
            'tags.index',
            'comments.index',
            'comments.store',
            'comments.show',
            'login',
            'forgot-password',
            'reset-password',
            'logout',
            'profile'
        ];

        foreach ($userPermissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $userRole->givePermissionTo($permission); // Asignar permisos limitados al rol User
        }

        $this->command->info('Roles y permisos generados correctamente.');
    }
}

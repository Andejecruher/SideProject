<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class GeneratePermissions extends Command
{
    protected $signature = 'permissions:generate';
    protected $description = 'Genera permisos automáticamente para cada ruta definida en el proyecto';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtiene todas las rutas registradas
        $routes = Route::getRoutes();

        $permissionsCreated = 0;

        foreach ($routes as $route) {
            // Obtén el nombre y la URI de la ruta
            $routeName = $route->getName();
            $routeUri = $route->uri();

            // Condición para ignorar rutas que contengan palabras específicas
            if ($routeName && !preg_match('/livewire|ignition|404|500|sanctum/i', $routeName) && !preg_match('/livewire|ignition|404|500/i', $routeUri)) {

                // Intentar extraer el grupo de la primera palabra del nombre de la ruta
                $group = 'other'; // Valor predeterminado para rutas que no siguen un formato específico
                if (preg_match('/^([a-zA-Z0-9_]+)/', $routeName, $matches)) {
                    $group = strtolower($matches[1]); // Extrae la primera palabra y la convierte a minúsculas
                }

                // Verifica si el permiso no existe ya
                if (Permission::where('name', $routeName)->doesntExist()) {
                    // Crea el permiso con el grupo asignado
                    Permission::create([
                        'name' => $routeName,
                        'group' => $group  // Asigna el grupo al permiso
                    ]);
                    $permissionsCreated++;
                    $this->info("Permiso creado: $routeName con grupo: $group");
                }
            }
        }

        $this->info("Permisos generados: $permissionsCreated.");
        return Command::SUCCESS;
    }
}

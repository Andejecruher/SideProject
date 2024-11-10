<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
  use HasFactory;

  // Puedes agregar relaciones personalizadas aquí si lo necesitas
  // Por ejemplo, para obtener roles con este permiso
  public function customRoles()
  {
    return $this->belongsToMany(Role::class);
  }
}

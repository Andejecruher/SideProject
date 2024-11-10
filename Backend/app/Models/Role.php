<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
  use HasFactory;

  // Puedes agregar relaciones personalizadas aquí si lo necesitas
  // Por ejemplo, para obtener usuarios con este rol
  public function customUsers()
  {
    return $this->belongsToMany(User::class);
  }
}

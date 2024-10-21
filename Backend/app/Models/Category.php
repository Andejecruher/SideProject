<?php
// app/Models/Categoria.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function articulos()
    {
        return $this->hasMany(Article::class);
    }
}

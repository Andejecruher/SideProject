<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Define the table name

    // Fillable attributes for mass assignment
    protected $fillable = [
        'name', // Name of the category
        'description', // Description of the category
        'icon', // Icon of the category
        'color',
    ];

    /**
     * Get the articles for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class); // Define a hasMany relationship with the Article model
    }
}

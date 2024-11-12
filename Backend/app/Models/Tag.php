<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Fillable attributes for mass assignment
    protected $fillable = [
        'name', // Name of the tag
        'color', // Color of the tag
    ];

    /**
     * The articles that belong to the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag'); // Define a belongsToMany relationship with the Article model
    }
}

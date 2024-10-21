<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'article_tag';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'article_id', // Foreign key to the articles table
        'tag_id', // Foreign key to the tags table
    ];

    /**
     * Get the article that owns the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class); // Define a belongsTo relationship with the Article model
    }

    /**
     * Get the tag that owns the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class); // Define a belongsTo relationship with the Tag model
    }
}

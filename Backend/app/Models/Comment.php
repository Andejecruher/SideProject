<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'content', // Content of the comment
        'author_name', // Name of the author
        'article_id', // Foreign key to the articles table
        'author_email', // Email of the author
        'published_at', // Date and time when the comment was published
        'ip_address', // IP address of the author
    ];

    /**
     * Get the article that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class); // Define a belongsTo relationship with the Article model
    }

    /**
     * Get the user that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Define a belongsTo relationship with the User model
    }
}

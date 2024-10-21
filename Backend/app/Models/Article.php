<?php
// app/Models/Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'title', // Title of the article
        'description', // Description of the article
        'content', // Content of the article
        'featured_image', // Featured image of the article
        'thumbnail', // Thumbnail image of the article
        'published', // Published status of the article
        'publication_date', // Publication date of the article
        'category_id', // Foreign key to the categories table
        'user_id', // Foreign key to the users table
    ];

    /**
     * Get the user that owns the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Define a belongsTo relationship with the User model
    }

    /**
     * Get the comments for the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class); // Define a hasMany relationship with the Comment model
    }

    /**
     * Get the category that owns the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Define a belongsTo relationship with the Category model
    }

    /**
     * The tags that belong to the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class); // Define a belongsToMany relationship with the Tag model
    }
}

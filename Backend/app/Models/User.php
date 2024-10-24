<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'first_name', // First name of the user
        'last_name', // Last name of the user
        'avatar', // Avatar image of the user
        'gender', // Gender of the user
        'email', // Email address of the user
        'password', // Password of the user
        'address', // Address of the user
        'phone', // Phone number of the user
        'city', // City of the user
        'postal_code', // Postal code of the user
        'status', // Status of the user (e.g., active, inactive)
        'role', // Role of the user (e.g., admin, user)
        'email_verified_at', // Timestamp when the email was verified
    ];

    // Hidden attributes for arrays
    protected $hidden = [
        'password', // Password of the user
        'remember_token', // Remember token for the user
    ];

    // Cast attributes to native types
    protected $casts = [
        'email_verified_at' => 'datetime', // Cast email_verified_at to datetime
    ];

    /**
     * Get the articles for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class); // Define a hasMany relationship with the Article model
    }
}

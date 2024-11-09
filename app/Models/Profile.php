<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Define the table if it's different from the default "profiles"
    protected $table = 'profiles';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id', // Assuming the profile is linked to a user
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'birthday',
        'address',
        'job_title',
        'linkedin',
        'profile_picture',
        'public_visibility'
    ];

    // Specify which attributes should be cast to specific types
    protected $casts = [
        'birthday' => 'date', // Ensure birthday is cast to date
        'public_visibility' => 'boolean', // Cast public visibility to a boolean
    ];

    // You can define relationships if needed (e.g., to a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

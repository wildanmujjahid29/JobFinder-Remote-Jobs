<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    //

    /**
     * Get the user associated with the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    /**
     * Get the user that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone',
        'bio',
        'profile_picture',
        'cv'
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}

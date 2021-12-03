<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property bigint unsigned $user_id user id
 * @property varchar $name name
 * @property timestamp $created_at created at
 * @property timestamp $updated_at updated at
 * @property timestamp $deleted_at deleted at
 * @property User $user belongsTo
   
 */
class Profile extends Model
{
    /**
     * Database table name
     */
    protected $table = 'profiles';

    /**
     * Use timestamps 
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'location',
        'bio',
        'twitter_name',
        'github_name',
        'avatar',
        'avartar_status'
    ];

    /**
     * user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Class UserRelationship.
 */
trait SocialAccountRelationship
{
    /*
     * User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}

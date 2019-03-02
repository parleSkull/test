<?php

namespace App\Models\Communication\Traits\Relationship;

use App\Models\Auth\User;

/**
 * Class MessageRelationship.
 */
trait MessageRelationship
{
    /*
     * Conversable
     */
    public function conversable(){
        return $this->morphTo();
    }

    /*
     * User
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}

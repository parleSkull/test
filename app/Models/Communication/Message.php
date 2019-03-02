<?php

namespace App\Models\Communication;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Communication\Traits\Relationship\MessageRelationship;
use App\Models\Communication\Traits\Method\MessageMethod;
use App\Models\Communication\Traits\Attribute\MessageAttribute;

class Message extends Model
{
    use SoftDeletes,
        MessageAttribute,
        MessageRelationship,
        MessageMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'recipient_id', 'conversable_id', 'conversable_type', 'data', 'read_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
        'read_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'json',
    ];
}

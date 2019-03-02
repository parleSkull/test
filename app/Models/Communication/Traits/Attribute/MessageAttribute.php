<?php

namespace App\Models\Communication\Traits\Attribute;

/**
 * Trait MessageAttribute.
 */
trait MessageAttribute
{
    /**
     * @return string
     */
    public function getRecipientAttribute()
    {
        return $this->recipient_id;
    }
}

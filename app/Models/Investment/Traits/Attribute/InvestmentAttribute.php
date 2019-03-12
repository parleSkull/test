<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 2/25/2019
 * Time: 20:48
 */

namespace App\Models\Investment\Traits\Attribute;

trait InvestmentAttribute{
    /**
     * @return string
     */
    public function getApiSelfLinkAttribute()
    {
        return url("api/investments/{$this->id}");
    }
}

<?php

namespace App\Http\Resources\Frontend\Investment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvestmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}

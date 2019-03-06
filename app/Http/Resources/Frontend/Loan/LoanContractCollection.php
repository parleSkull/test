<?php

namespace App\Http\Resources\Frontend\Loan;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoanContractCollection extends ResourceCollection
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

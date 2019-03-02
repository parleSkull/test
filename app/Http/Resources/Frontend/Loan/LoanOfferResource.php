<?php

namespace App\Http\Resources\Frontend\Loan;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Auth\User;

class LoanOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'present_value' => $this->present_value,
            'rate_per_period' => $this->rate_per_period,
            'number_of_periods' => $this->number_of_periods,
            'period_type' => $this->period_type,
            'algorithm_type' => $this->algorithm_type,
            'repayment_value' => $this->repayment_value,
            'funded' => $this->funded,
            'watchers' => $this->watchers,
            'accepted' => $this->accepted,
            'open' => $this->open,
            'self_link' => url('api/loan-offers/'.$this->id),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString()
        ];
    }
}

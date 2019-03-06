<?php

namespace App\Http\Resources\Frontend\Loan;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanContractResource extends JsonResource
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
            'consumer_id' => $this->consumer_id,
            'investor_id' => $this->investor_id,
            'deal_origin_id' => $this->deal_origin_id,
            'deal_origin_type' => $this->deal_origin_type,
            'present_value' => $this->present_value,
            'rate_per_period' => $this->rate_per_period,
            'number_of_periods' => $this->number_of_periods,
            'period_type' => $this->period_type,
            'algorithm_type' => $this->algorithm_type,
            'repayment_value' => $this->repayment_value,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString(),
        ];
    }
}

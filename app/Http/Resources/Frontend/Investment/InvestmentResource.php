<?php

namespace App\Http\Resources\Frontend\Investment;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentResource extends JsonResource
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
            'uuid' => $this->uuid,
            'user_id' => $this->user_id,
            'user_uuid' => $this->user_uuid,
            'alias' => $this->alias,
            'initial_value' => $this->initial_value,
            'current_value' => $this->current_value,
            'interest_rate' => $this->interest_rate,
            'deal_status' => $this->deal_status,
            'next_repayment_id' => $this->next_repayment_id,
            'next_repayment_value' => $this->next_repayment_value,
            'cumulative_interest' => $this->cumulative_interest,
            'service_charge_value' => $this->service_charge_value,
            'start_at' => optional($this->start_at)->toDateTimeString(),
            'next_payment_at' => optional($this->next_payment_at)->toDateTimeString(),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString()
        ];
    }
}

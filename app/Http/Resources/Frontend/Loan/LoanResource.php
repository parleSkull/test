<?php

namespace App\Http\Resources\Frontend\Loan;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'purpose' => $this->purpose,
            'requested_value' => $this->requested_value,
            'disbursed_value' => $this->disbursed_value,
            'service_charge_value' => $this->service_charge_value,
            'repayment_value' => $this->repayment_value,
            'interest_rate' => $this->interest_rate,
            'interest_value' => $this->interest_value,
            'number_of_payments' => $this->number_of_payments,
            'deal_status' => $this->deal_status,
            'next_repayment_id' => $this->next_repayment_id,
            'next_repayment_value' => $this->next_repayment_value,
            'start_at' => optional($this->start_at)->toDateTimeString(),
            'due_at' => optional($this->due_at)->toDateTimeString(),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString()
        ];
    }
}

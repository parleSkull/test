<?php

namespace App\Http\Resources\Frontend\Loan;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanRequestResource extends JsonResource
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
            'number_of_periods' => $this->number_of_periods,
            'period_type' => $this->period_type,
            'granted' => $this->granted,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString(),
            'self_link' => $this->when(!is_null($this->api_self_link), $this->api_self_link)
        ];
    }
}

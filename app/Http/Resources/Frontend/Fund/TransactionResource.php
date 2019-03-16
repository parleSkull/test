<?php

namespace App\Http\Resources\Frontend\Fund;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hash' => $this->hash,
            'wallet_id' => $this->wallet_id,
            'transaction_mode' => $this->transaction_mode,
            'transaction_type' => $this->transaction_type,
            'amount' => $this->amount,
            'transaction_status' => $this->transaction_status,
            'accepted' => $this->accepted,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString()
        ];
    }
}

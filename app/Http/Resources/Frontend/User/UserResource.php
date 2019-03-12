<?php

namespace App\Http\Resources\Frontend\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'account_type' => $this->account_type,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->when($this->isSelf(), $this->email),
            'avatar_type' => $this->avatar_type,
            'avatar_url' => $this->avatar_url,
            'phone_number' => $this->phone_number,
            'active' => $this->active,
            'confirmed' => $this->confirmed,
            'timezone' => $this->timezone,
            'nationality' => $this->nationality,
            'bio' => $this->bio,
            'address' => $this->address,
            'referral_code' => $this->referral_code,
            'referrer_code' => $this->referrer_code,
            'last_login_at' => $this->last_login_at,
            'last_login_ip' => $this->last_login_ip,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
            'deleted_at' => optional($this->deleted_at)->toDateTimeString()

        ];
    }
}

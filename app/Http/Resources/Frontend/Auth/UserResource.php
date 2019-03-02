<?php

namespace App\Http\Resources\Frontend\Auth;

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
            'cover_url' => $this->cover_url,
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
            $this->mergeWhen(! is_null($this->access_token), [
                'access_token_type' => $this->access_token['type'],
                'access_token_value' => $this->access_token['value'],
                'access_token_expires_in' => $this->access_token['expires_in'],
            ]),
        ];
    }
}

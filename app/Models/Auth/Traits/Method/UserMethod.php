<?php

namespace App\Models\Auth\Traits\Method;

use App\Enums\TransactionMode;
use App\Enums\TransactionStatus;
use Illuminate\Support\Facades\Redis;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    /**
     * Generates a valid personal access token.
     *
     * @return string
     */
    public function generateAccessToken()
    {
        $token = $this->createToken($this->username . ' - ' . now()->toDateTimeString());
        return $token;
    }

    /**
     * Set user's default data into cache to save few queries.
     *
     * @return void
     */
    public function storeInRedis()
    {
        $userData = [
            'submissionsCount' => 0,
            'commentsCount'    => 0,

            'submissionXp' => 0,
            'commentXp'    => 0,

            'hiddenSubmissions' => collect(),
            'subscriptions'     => collect(),

            'blockedUsers' => collect(),

            'submissionLikes'   => collect(),

            'bookmarkedSubmissions' => collect(),
            'bookmarkedComments'    => collect(),
            'bookmarkedChannels'    => collect(),
            'bookmarkedUsers'       => collect(),

            'commentLikes'   => collect(),
        ];

        Redis::hmset('user.'.$this->id.'.data', $userData);
    }

    /*
     * Check if user is themselves
     */
    public function isSelf()
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->id === auth()->id();
    }

    /**
     * Determine if the user can withdraw the given amount
     * @param  double $amount
     * @return boolean
     */
    public function canWithdraw($amount)
    {
        return $this->balance >= $amount;
    }

    /**
     * Move credits to this account
     * @param  double $amount
     * @param  string $type
     * @param  array $meta
     * @param bool $accepted
     */
    public function deposit($amount, $type = 'Deposit', $meta = [], $accepted = true)
    {
        $pre_bal = $this->wallet->balance;
        $post_bal = $pre_bal;
        $status = TransactionStatus::FAILED;

        if ($accepted) {
            $pre_bal = $this->wallet->balance;
            $this->wallet->balance += $amount;
            $this->wallet->save();
            $post_bal = $this->wallet->balance;
            $status = TransactionStatus::SUCCESS;
        } elseif (! $this->wallet->exists) {
            $this->wallet->save();
        }

        $this->wallet->transactions()
            ->create([
                'amount' => $amount,
                'hash' => uniqid('sfdp_'),
                'transaction_mode' => TransactionMode::Credit,
                'transaction_type' => $type,
                'transaction_status' => $status,
                'pre_balance' => $pre_bal,
                'post_balance' => $post_bal,
                'accepted' => $accepted,
                'meta' => $meta
            ]);
    }

    /**
     * Fail to move credits to this account
     * @param  integer $amount
     * @param  string  $type
     * @param  array   $meta
     */
    public function failDeposit($amount, $type = 'deposit', $meta = [])
    {
        $this->deposit($amount, $type, $meta, false);
    }

    /**
     * Attempt to move credits from this account
     * @param  integer $amount
     * @param  string  $type
     * @param  array   $meta
     * @param  boolean $shouldAccept
     */
    public function withdraw($amount, $type = 'Withdraw', $meta = [], $shouldAccept = true)
    {
        $pre_bal = $this->wallet->balance;
        $post_bal = $pre_bal;
        $status = TransactionStatus::FAILED;

        $accepted = $shouldAccept ? $this->canWithdraw($amount) : true;

        if ($accepted) {
            $pre_bal = $this->wallet->balance;
            $this->wallet->balance -= $amount;
            $this->wallet->save();
            $post_bal = $this->wallet->balance;
            $status = TransactionStatus::SUCCESS;
        } elseif (! $this->wallet->exists) {
            $this->wallet->save();
        }

        $this->wallet->transactions()
            ->create([
                'amount' => $amount,
                'hash' => uniqid('sfwd_'),
                'transaction_mode' => TransactionMode::Debit,
                'transaction_type' => $type,
                'transaction_status' => $status,
                'pre_balance' => $pre_bal,
                'post_balance' => $post_bal,
                'accepted' => $accepted,
                'meta' => $meta
            ]);
    }

    /**
     * Move credits from this account
     * @param  integer $amount
     * @param  string  $type
     * @param  array   $meta
     * @param  boolean $shouldAccept
     */
    public function forceWithdraw($amount, $type = 'withdraw', $meta = [])
    {
        return $this->withdraw($amount, $type, $meta, false);
    }

    /**
     * @return mixed
     */
    public function canChangeEmail()
    {
        return config('access.users.change_email');
    }

    /**
     * @return bool
     */
    public function canChangePassword()
    {
        return ! app('session')->has(config('access.socialite_session_name'));
    }

    /**
     * @param bool $size
     *
     * @return bool|\Illuminate\Contracts\Routing\UrlGenerator|mixed|string
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function getPicture($size = false)
    {
        switch ($this->avatar_type) {
            case 'gravatar':
                if (! $size) {
                    $size = config('gravatar.default.size');
                }

                return gravatar()->get($this->email, ['size' => $size]);

            case 'storage':
                return url('storage/'.$this->avatar_url);
        }

        $social_avatar = $this->providers()->where('provider', $this->avatar_type)->first();
        if ($social_avatar && strlen($social_avatar->avatar)) {
            return $social_avatar->avatar;
        }

        return false;
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->hasRole(config('access.users.admin_role'));
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return config('access.users.requires_approval') && ! $this->confirmed;
    }
}


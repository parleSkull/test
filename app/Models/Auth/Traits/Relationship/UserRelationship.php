<?php

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Communication\Message;
use App\Models\Fund\Transaction;
use App\Models\Fund\Wallet;
use App\Models\Loan\LoanOffer;
use App\Models\Loan\LoanRequest;
use App\Models\System\Session;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * Social Accounts
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * User sessions
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Password histories
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /*
     * SocialLogins
     */
    public function social_logins(){
        return $this->hasMany(SocialAccount::class);
    }

    /*
     * Wallet
     */
    public function wallet(){
        return $this->hasOne(Wallet::class);
    }

    /*
     * Transactions
     */
    public function transactions(){
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    /*
     * Messages
     */
    public function messages(){
        return $this->hasMany(Message::class);
    }

    /*
     * Loan Offers
     */
    public function loan_offers(){
        return $this->hasMany(LoanOffer::class);
    }

    /*
     * Loan Requests
     */
    public function loan_requests(){
        return $this->hasMany(LoanRequest::class);
    }
}

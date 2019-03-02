<?php

use App\Models\Auth\User;
use App\Models\Fund\Wallet;
use App\Models\Fund\Transaction;

return [

    /**
     * Which model is your User's
     */
    'user_model' => User::class,

    /**
     * Change this if you extend the default Wallet Model
     */
    'wallet_model' => Wallet::class,

    /**
     * Change this if you extend the default Transaction Model
     */
    'transaction_model' => Transaction::class,

];
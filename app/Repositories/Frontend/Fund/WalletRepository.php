<?php

namespace App\Repositories\Frontend\Fund;

use App\Models\Fund\Wallet;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Auth\User;

/**
 * Class WalletRepository.
 */
class WalletRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Wallet::class;
    }

    /**
     * @param User $user
     * @param double $amount
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function deposit(User $user, $amount) : Wallet
    {
        return DB::transaction(
        /**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($user, $amount) {
                $user->deposit($amount);
                $wallet = $user->wallet;

                if ($wallet) {
                    /*
                    * Return the wallet object
                    */
                    return $wallet;
                }
                throw new GeneralException(__('exceptions.frontend.wallets.deposit_error'));
            });
    }

    /**
     * @param User $user
     * @param double $amount
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function withdraw(User $user, $amount) : Wallet
    {
        return DB::transaction(
        /**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($user, $amount) {
                $user->withdraw($amount);
                $wallet = $user->wallet;

                if ($wallet) {
                    /*
                    * Return the wallet object
                    */
                    return $wallet;
                }
                throw new GeneralException(__('exceptions.frontend.wallets.withdraw_error'));
            });
    }
}

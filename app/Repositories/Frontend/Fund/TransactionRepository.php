<?php

namespace App\Repositories\Frontend\Fund;

use App\Models\Fund\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Auth\User;

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Transaction::class;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param $walletId
     * @return mixed
     */
    public function getPaginatedByWallet($paged = 25, $orderBy = 'created_at', $sort = 'desc', $walletId) : LengthAwarePaginator
    {
        return $this->model
            ->EWallet($walletId)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }
}

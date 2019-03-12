<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Investment\InvestmentCreated;
use App\Events\Frontend\Investment\InvestmentUpdated;
use App\Models\Investment\Investment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class InvestmentRepository.
 */
class InvestmentRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Investment::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
//        ->with('user')  ->open()
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $data) : Investment
    {
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($data) {
            $investment = parent::create([
                'user_id'           => $data['user_id'],
                'initial_value'          => $data['initial_value'],
                'current_value'        => $data['current_value'],
                'interest_rate'         => $data['interest_rate']
            ]);

            if ($investment) {
                /*
                 * Raise Investment created event
                 */
                event(new InvestmentCreated($investment));

                /*
                * Return the investment object
                */
                return $investment;
            }

            throw new GeneralException(__('exceptions.frontend.investments.create_error'));
        });
    }

    /**
     * @param Investment  $investment
     * @param array $data
     *
     * @return Investment
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Investment $investment, array $data) : Investment
    {
        return DB::transaction(function () use ($investment, $data) {
            if ($investment->update([
                'initial_value'          => $data['initial_value'],
                'current_value'        => $data['current_value'],
                'interest_rate'         => $data['interest_rate']
            ])) {
                event(new InvestmentUpdated($investment));

                return $investment;
            }

            throw new GeneralException(__('exceptions.frontend.investments.update_error'));
        });
    }
}

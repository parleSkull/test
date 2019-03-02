<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Loan\LoanOfferCreated;
use App\Events\Frontend\Loan\LoanOfferUpdated;
use App\Models\Loan\LoanOffer;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class LoanOfferRepository.
 */
class LoanOfferRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return LoanOffer::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getOpenPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
//        ->with('user')
        return $this->model
            ->open()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $data) : LoanOffer
    {
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($data) {
            $loanOffer = parent::create([
                'user_id'           => $data['user_id'],
                'present_value'          => $data['present_value'],
                'rate_per_period'        => $data['rate_per_period'],
                'number_of_periods'         => $data['number_of_periods'],
                'period_type'             => $data['period_type'],
                'algorithm_type'             => $data['algorithm_type'],
                'repayment_value' => $data['repayment_value'],
                'funded'            => $data['funded'],
            ]);

            if ($loanOffer) {
                /*
                 * Raise LoanOffer created event
                 */
                event(new LoanOfferCreated($loanOffer));

                /*
                * Return the loanOffer object
                */
                return $loanOffer;
            }

            throw new GeneralException(__('exceptions.frontend.loans.offers.create_error'));
        });
    }

    /**
     * @param LoanOffer  $loanOffer
     * @param array $data
     *
     * @return LoanOffer
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(LoanOffer $loanOffer, array $data) : LoanOffer
    {
        return DB::transaction(function () use ($loanOffer, $data) {
            if ($loanOffer->update([
                'present_value'          => $data['present_value'],
                'rate_per_period'        => $data['rate_per_period'],
                'number_of_periods'         => $data['number_of_periods'],
                'period_type'             => $data['period_type'],
                'algorithm_type'             => $data['algorithm_type'],
                'repayment_value' => $data['repayment_value'],
                'funded'            => $data['funded'],
                'accepted'            => $data['accepted'],
                'open'            => $data['open']
            ])) {
                event(new LoanOfferUpdated($loanOffer));

                return $loanOffer;
            }

            throw new GeneralException(__('exceptions.frontend.loans.offers.update_error'));
        });
    }
}

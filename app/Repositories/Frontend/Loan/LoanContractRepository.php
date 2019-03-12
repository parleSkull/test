<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Loan\LoanPaymentCreated;
use App\Events\Frontend\Loan\LoanPaymentUpdated;
use App\Models\Loan\LoanPayment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class LoanContractRepository.
 */
class LoanContractRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return LoanPayment::class;
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param $status
     * @param $userId
     * @return mixed
     */
    public function getOpenPaginatedByUserByStatus($paged = 25, $orderBy = 'created_at', $sort = 'desc', $status, $userId) : LengthAwarePaginator
    {
//        ->with('user')
        return $this->model
            ->ofUser($userId)
            ->ofStatus($status)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getOpenPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
//        ->with('user')
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
    public function create(array $data) : LoanPayment
    {
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($data) {
            $loanContract = parent::create([
                'consumer_id'           => $data['consumer_id'],
                'investor_id'           => $data['investor_id'],
                'deal_origin_id'           => $data['deal_origin_id'],
                'deal_origin_type'           => $data['deal_origin_type'],
                'present_value'          => $data['present_value'],
                'period_type'          => $data['period_type'],
                'rate_per_period'        => $data['rate_per_period'],
                'number_of_periods'         => $data['number_of_periods'],
                'algorithm_type'             => $data['algorithm_type'],
                'repayment_value' => $data['repayment_value'],
                'status'            => $data['status']
            ]);

            if ($loanContract) {
                /*
                 * Raise LoanContract created event
                 */
                event(new LoanPaymentCreated($loanContract));

                /*
                * Return the loanContract object
                */
                return $loanContract;
            }

            throw new GeneralException(__('exceptions.frontend.loans.contracts.create_error'));
        });
    }

    /**
     * @param LoanPayment  $loanContract
     * @param array $data
     *
     * @return LoanPayment
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(LoanPayment $loanContract, array $data) : LoanPayment
    {
        return DB::transaction(function () use ($loanContract, $data) {
            if ($loanContract->update([
                'present_value'          => $data['present_value'],
                'period_type'          => $data['period_type'],
                'rate_per_period'        => $data['rate_per_period'],
                'number_of_periods'         => $data['number_of_periods'],
                'algorithm_type'             => $data['algorithm_type'],
                'repayment_value' => $data['repayment_value'],
                'status'            => $data['status']
            ])) {
                event(new LoanPaymentUpdated($loanContract));

                return $loanContract;
            }

            throw new GeneralException(__('exceptions.frontend.loans.contracts.update_error'));
        });
    }
}

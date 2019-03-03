<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Loan\LoanRequestCreated;
use App\Events\Frontend\Loan\LoanRequestUpdated;
use App\Models\Loan\LoanRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class LoanRequestRepository.
 */
class LoanRequestRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return LoanRequest::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getUnGrantedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
//        ->with('user')
        return $this->model
            ->granted(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $data) : LoanRequest
    {
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($data) {
            $loanRequest = parent::create([
                'user_id'           => $data['user_id'],
                'present_value'          => $data['present_value'],
                'number_of_periods'         => $data['number_of_periods'],
                'period_type'             => $data['period_type']
            ]);

            if ($loanRequest) {
                /*
                 * Raise loanRequest created event
                 */
                event(new LoanRequestCreated($loanRequest));

                /*
                * Return the loanRequest object
                */
                return $loanRequest;
            }

            throw new GeneralException(__('exceptions.frontend.loans.requests.create_error'));
        });
    }

    /**
     * @param LoanRequest  $loanRequest
     * @param array $data
     *
     * @return LoanRequest
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(LoanRequest $loanRequest, array $data) : LoanRequest
    {
        return DB::transaction(function () use ($loanRequest, $data) {
            if ($loanRequest->update([
                'present_value'          => $data['present_value'],
                'number_of_periods'         => $data['number_of_periods'],
                'period_type'             => $data['period_type'],
                'granted'            => $data['granted'],
            ])) {
                event(new LoanRequestUpdated($loanRequest));

                return $loanRequest;
            }

            throw new GeneralException(__('exceptions.frontend.loans.requests.update_error'));
        });
    }
}

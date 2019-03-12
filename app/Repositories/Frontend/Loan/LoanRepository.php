<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Loan\LoanCreated;
use App\Events\Frontend\Loan\LoanUpdated;
use App\Models\Loan\Loan;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class LoanRepository.
 */
class LoanRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return Loan::class;
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
//        ->with('user') ->granted(false)
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
    public function create(array $data) : Loan
    {
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($data) {
            $loan = parent::create([
                'user_id'           => $data['user_id'],
                'requested_value'          => $data['present_value']
            ]);

            if ($loan) {
                /*
                 * Raise loan created event
                 */
                event(new LoanCreated($loan));

                /*
                * Return the loan object
                */
                return $loan;
            }

            throw new GeneralException(__('exceptions.frontend.loans.create_error'));
        });
    }

    /**
     * @param Loan  $loan
     * @param array $data
     *
     * @return Loan
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Loan $loan, array $data) : Loan
    {
        return DB::transaction(function () use ($loan, $data) {
            if ($loan->update([
                'requested_value'          => $data['present_value']
            ])) {
                event(new LoanUpdated($loan));

                return $loan;
            }

            throw new GeneralException(__('exceptions.frontend.loans.update_error'));
        });
    }
}

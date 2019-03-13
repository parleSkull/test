<?php

namespace App\Repositories\Frontend\Loan;

use App\Events\Frontend\Loan\LoanCreated;
use App\Events\Frontend\Loan\LoanUpdated;
use App\Models\Loan\Loan;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Company\LoanType;
use App\Models\Auth\User;

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
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param $userId
     * @return mixed
     */
    public function getPaginatedByUser($paged = 25, $orderBy = 'created_at', $sort = 'desc', $userId) : LengthAwarePaginator
    {
//        ->with('user') ->granted(false)
        return $this->model
            ->owner($userId)
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
        $newData['user_id'] = $data['user_id'];
        $newData['user_uuid'] = User::find($data['user_id'])->uuid;
        $newData['alias'] = $data['alias'];
        $newData['purpose'] = $data['purpose'];
        $newData['requested_value'] = $data['requested_value'];
        $newData['interest_rate'] = LoanType::where('name', '=', 'Standard')->value('interest_rate_pm');
        $newData['repayment_value'] = (($newData['interest_rate'] + 100.00) / 100) * $newData['requested_value'];
        $newData['interest_value'] = $newData['repayment_value'] - $newData['requested_value'];
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($newData) {
            $loan = parent::create($newData);

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
                'purpose'           => $data['purpose'],
                'alias'           => $data['alias'],
                'requested_value'          => $data['present_value']
            ])) {
                event(new LoanUpdated($loan));

                return $loan;
            }

            throw new GeneralException(__('exceptions.frontend.loans.update_error'));
        });
    }
}

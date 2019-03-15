<?php

namespace App\Repositories\Frontend\Loan;

use App\Enums\DealStatus;
use App\Events\Frontend\Investment\InvestmentCreated;
use App\Events\Frontend\Investment\InvestmentUpdated;
use App\Models\Company\InvestmentType;
use App\Models\Investment\Investment;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Auth\User;

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
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @param $userId
     * @return mixed
     */
    public function getPaginatedByUser($paged = 25, $orderBy = 'created_at', $sort = 'desc', $userId) : LengthAwarePaginator
    {
//        ->with('user')  ->open()
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
    public function create(array $data) : Investment
    {
        $newData['user_id'] = $data['user_id'];
        $newData['user_uuid'] = User::find($data['user_id'])->uuid;
        $newData['alias'] = $data['alias'];
        $newData['initial_value'] = $data['initial_value'];
        $newData['current_value'] = $data['initial_value'];
        $newData['deal_status'] = DealStatus::QUEUED;
        $newData['cumulative_interest'] = 0.00;
        $newData['interest_rate'] = InvestmentType::where('name', '=', 'Standard')->value('interest_rate_pa');
        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($newData) {
            $investment = parent::create($newData);

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
                'alias'           => $data['alias'],
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

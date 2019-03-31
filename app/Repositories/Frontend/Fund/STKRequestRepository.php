<?php

namespace App\Repositories\Frontend\Fund;

use App\Models\MobileMoney\Mpesa\C2B\STKRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Auth\User;

/**
 * Class STKRequestRepository.
 */
class STKRequestRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return STKRequest::class;
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $data) : STKRequest
    {
        $newData['user_id'] = $data['user_id'];
        $newData['user_uuid'] = $data['user_uuid'];
        $newData['PhoneNumber'] = $data['msisdn'];
        $newData['Amount'] = $data['dueAmount'];

        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($newData) {
                $loan = parent::create($newData);

                if ($loan) {
                    /*
                     * Raise loan created event
                     */
//                    event(new LoanCreated($loan));

                    /*
                    * Return the loan object
                    */
                    return $loan;
                }

                throw new GeneralException(__('exceptions.frontend.stk-request.create_error'));
            });
    }
}

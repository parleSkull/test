<?php

namespace App\Repositories\Frontend\Fund\MTN;

//use App\Events\Frontend\RequestPaymentResponse\RequestPaymentResponseCreated;
//use App\Events\Frontend\RequestPaymentResponse\RequestPaymentResponseUpdated;
use App\Models\MobileMoney\mtn\Common\Common;
use App\Models\MobileMoney\mtn\Common\ConfigurationReader;
use App\Models\MobileMoney\mtn\Model\RequestPaymentResponse;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
//use App\Models\Company\RequestPaymentResponseType;
use App\Models\Auth\User;
use App\Enums\DealStatus;

/**
 * Class RequestPaymentResponseRepository.
 */
class RequestPaymentResponseRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return RequestPaymentResponse::class;
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
    public function create(array $data) : RequestPaymentResponse
    {
        $newData['processingNumber'] = $data['processingNumber'];
        $newData['thirdPartyAcctRef'] = $data['thirdPartyAcctRef'];
        $newData['senderID'] = $data['senderID'];
        $newData['statusCode'] = $data['statusCode'];
        $newData['statusDesc'] = $data['statusDesc'];
        $newData['mOMTransactionID'] = $data['mOMTransactionID'];

        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($newData) {
            $requestPaymentResponse = parent::create($newData);

            if ($requestPaymentResponse) {
                /*
                 * Raise requestPaymentResponse created event
                 */
//                event(new RequestPaymentResponseCreated($requestPaymentResponse));

                /*
                * Return the requestPaymentResponse object
                */
                return $requestPaymentResponse;
            }

            throw new GeneralException("Error creating RequestPaymentResponse");
        });
    }
}

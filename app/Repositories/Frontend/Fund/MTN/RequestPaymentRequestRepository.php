<?php

namespace App\Repositories\Frontend\Fund\MTN;

//use App\Events\Frontend\RequestPaymentRequest\RequestPaymentRequestCreated;
//use App\Events\Frontend\RequestPaymentRequest\RequestPaymentRequestUpdated;
use App\Models\MobileMoney\mtn\Common\Common;
use App\Models\MobileMoney\mtn\Common\ConfigurationReader;
use App\Models\MobileMoney\mtn\Model\RequestPaymentRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
//use App\Models\Company\RequestPaymentRequestType;
use App\Models\Auth\User;
use App\Enums\DealStatus;

/**
 * Class RequestPaymentRequestRepository.
 */
class RequestPaymentRequestRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function model()
    {
        return RequestPaymentRequest::class;
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
    public function fill(array $data) : RequestPaymentRequest
    {
        $newData['user_id'] = $data['user_id'];
        $newData['DueAmount'] = $data['DueAmount'];
        $newData['MSISDNNum'] = $data['MSISDNNum'];
        $newData['AcctRef'] = $data['AcctRef'];
        $newData['AcctBalance'] = $data['AcctBalance'];
        $newData['timeStamp'] = $data['timeStamp'];
        $newData['spId'] = ConfigurationReader::getProperty('spId');
        $newData['spPassword'] = ConfigurationReader::getProperty('spPassword');
        $newData['serviceId'] = ConfigurationReader::getProperty('serviceId');
        $newData['MinDueAmount'] = ConfigurationReader::getProperty('MinDueAmount');
        $newData['opCoId'] = ConfigurationReader::getProperty('opCoId');
        $newData['PrefLang'] = ConfigurationReader::getProperty('PrefLang');
        $newData['Narration'] = ConfigurationReader::getProperty('Narration');
        $newData['senderId'] = ConfigurationReader::getProperty('senderId');
        $newData['bundleID'] = ConfigurationReader::getProperty('bundleID');
        $newData['CurrCode'] = ConfigurationReader::getProperty('CurrCode');
        $newData['ProcessingNumber'] = Common::generateMoMUniqueIdentifier();
        return new RequestPaymentRequest($newData);
    }

    /**
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     * @throws \Throwable
     */
    public function create(array $data) : RequestPaymentRequest
    {
        $newData['DueAmount'] = $data['DueAmount'];
        $newData['MSISDNNum'] = $data['MSISDNNum'];
        $newData['AcctRef'] = $data['AcctRef'];
        $newData['acctBalance'] = $data['acctBalance'];
        $newData['spId'] = ConfigurationReader::getProperty('spId');
        $newData['spPassword'] = ConfigurationReader::getProperty('spPassword');
        $newData['serviceId'] = ConfigurationReader::getProperty('serviceId');
        $newData['MinDueAmount'] = ConfigurationReader::getProperty('MinDueAmount');
        $newData['OpCoID'] = ConfigurationReader::getProperty('OpCoID');
        $newData['PrefLang'] = ConfigurationReader::getProperty('PrefLang');
        $newData['Narration'] = ConfigurationReader::getProperty('Narration');
        $newData['senderId'] = ConfigurationReader::getProperty('senderId');
        $newData['bundleID'] = ConfigurationReader::getProperty('bundleID');
        $newData['ProcessingNumber'] = Common::generateMoMUniqueIdentifier();

        return DB::transaction(/**
         * @return \Illuminate\Database\Eloquent\Model
         */
            function () use ($newData) {
            $requestPaymentRequest = parent::create($newData);

            if ($requestPaymentRequest) {
                /*
                 * Raise requestPaymentRequest created event
                 */
//                event(new RequestPaymentRequestCreated($requestPaymentRequest));

                /*
                * Return the requestPaymentRequest object
                */
                return $requestPaymentRequest;
            }

            throw new GeneralException("Error creating RequestPaymentRequest");
        });
    }
}

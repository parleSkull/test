<?php

namespace App\Http\Controllers\Frontend\Loan\API;

use App\Events\Frontend\Loan\LoanOfferDeleted;
use App\Http\Requests\Frontend\Loan\API\DeleteLoanOfferRequest;
use App\Http\Requests\Frontend\Loan\API\ListLoanOfferRequest;
use App\Http\Requests\Frontend\Loan\API\StoreLoanOfferRequest;
use App\Http\Requests\Frontend\Loan\API\UpdateLoanOfferRequest;
use App\Http\Resources\Frontend\Loan\LoanOfferCollection;
use App\Http\Resources\Frontend\Loan\LoanOfferResource;
use App\Models\Loan\LoanOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Loan\LoanOfferRepository;

class LoanOfferController extends Controller
{
    /**
     * @var LoanOfferRepository
     */
    protected $loanOfferRepository;

    /**
     * LoanOfferController constructor.
     *
     * @param LoanOfferRepository $loanOfferRepository
     */
    public function __construct(LoanOfferRepository $loanOfferRepository)
    {
        $this->loanOfferRepository = $loanOfferRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ListLoanOfferRequest $request
     * @return LoanOfferCollection|\Illuminate\Http\Response
     */
    public function index(ListLoanOfferRequest $request)
    {
        return new LoanOfferCollection($this->loanOfferRepository->getOpenPaginated(25, 'id', 'asc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLoanOfferRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(StoreLoanOfferRequest $request)
    {
        $loanOffer = $this->loanOfferRepository->create(array_add($request->only(
            'present_value',
            'rate_per_period',
            'number_of_periods',
            'period_type',
            'algorithm_type',
            'repayment_value',
            'funded'
        ), 'user_id', $request->user()->id));

        //return res(201, __('alerts.frontend.loans.offers.created'));
        return (new LoanOfferResource($loanOffer))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param ListLoanOfferRequest $request
     * @param  \App\Models\Loan\LoanOffer $loanOffer
     * @return LoanOfferResource|mixed
     */
    public function show(ListLoanOfferRequest $request, LoanOffer $loanOffer)
    {
        return new LoanOfferResource($loanOffer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLoanOfferRequest $request
     * @param  \App\Models\Loan\LoanOffer $loanOffer
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(UpdateLoanOfferRequest $request, LoanOffer $loanOffer)
    {
        $loanOffer = $this->loanOfferRepository->update($loanOffer, $request->only(
            'present_value',
            'rate_per_period',
            'number_of_periods',
            'period_type',
            'algorithm_type',
            'repayment_value',
            'funded',
            'accepted',
            'open'
        ));

        //return res(200, __('alerts.frontend.loans.offers.updated'));
        return (new LoanOfferResource($loanOffer))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan\LoanOffer $loanOffer
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(DeleteLoanOfferRequest $request, LoanOffer $loanOffer)
    {
        $this->loanOfferRepository->deleteById($loanOffer->id);

        event(new LoanOfferDeleted($loanOffer));

//        __('alerts.frontend.loans.offers.deleted')

        return res(200, 'Delete Successful');
    }
}

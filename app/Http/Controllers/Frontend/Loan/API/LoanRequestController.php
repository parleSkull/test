<?php

namespace App\Http\Controllers\Frontend\Loan\API;

use App\Events\Frontend\Loan\LoanRequestDeleted;
use App\Http\Requests\Frontend\Loan\API\DeleteLoanRequestRequest;
use App\Http\Requests\Frontend\Loan\API\ListLoanRequestRequest;
use App\Http\Requests\Frontend\Loan\API\StoreLoanRequestRequest;
use App\Http\Requests\Frontend\Loan\API\UpdateLoanRequestRequest;
use App\Http\Resources\Frontend\Loan\LoanRequestCollection;
use App\Http\Resources\Frontend\Loan\LoanRequestResource;
use App\Models\Loan\LoanRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Loan\LoanRequestRepository;

class LoanRequestController extends Controller
{
    /**
     * @var LoanRequestRepository
     */
    protected $loanRequestRepository;

    /**
     * LoanRequestController constructor.
     *
     * @param LoanRequestRepository $loanRequestRepository
     */
    public function __construct(LoanRequestRepository $loanRequestRepository)
    {
        $this->loanRequestRepository = $loanRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ListLoanRequestRequest $request
     * @return LoanRequestCollection|\Illuminate\Http\Response
     */
    public function index(ListLoanRequestRequest $request)
    {
        return new LoanRequestCollection($this->loanRequestRepository->getUnGrantedPaginated(25, 'id', 'asc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLoanRequestRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(StoreLoanRequestRequest $request)
    {
        $loanRequest = $this->loanRequestRepository->create(array_add($request->only(
            'present_value',
            'number_of_periods',
            'period_type'
        ), 'user_id', $request->user()->id));

        //return res(201, __('alerts.frontend.loans.Requests.created'));
        return (new LoanRequestResource($loanRequest))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param ListLoanRequestRequest $request
     * @param  \App\Models\Loan\LoanRequest $loanRequest
     * @return LoanRequestResource|mixed
     */
    public function show(ListLoanRequestRequest $request, LoanRequest $loanRequest)
    {
        return new LoanRequestResource($loanRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLoanRequestRequest $request
     * @param  \App\Models\Loan\LoanRequest $loanRequest
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(UpdateLoanRequestRequest $request, LoanRequest $loanRequest)
    {
        $loanRequest = $this->loanRequestRepository->update($loanRequest, $request->only(
            'present_value',
            'number_of_periods',
            'period_type',
            'granted'
        ));

        //return res(200, __('alerts.frontend.loans.Requests.updated'));
        return (new LoanRequestResource($loanRequest))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan\LoanRequest $loanRequest
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(DeleteLoanRequestRequest $request, LoanRequest $loanRequest)
    {
        $this->loanRequestRepository->deleteById($loanRequest->id);

        event(new LoanRequestDeleted($loanRequest));

//        __('alerts.frontend.loans.Requests.deleted')

        return res(200, 'Delete Successful');
    }
}

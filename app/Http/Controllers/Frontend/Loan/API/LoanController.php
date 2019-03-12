<?php

namespace App\Http\Controllers\Frontend\Loan\API;

use App\Events\Frontend\Loan\LoanDeleted;
use App\Http\Resources\Frontend\Loan\LoanCollection;
use App\Http\Resources\Frontend\Loan\LoanResource;
use App\Models\Loan\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Loan\LoanRepository;

class LoanController extends Controller
{
    /**
     * @var LoanRepository
     */
    protected $loanRepository;

    /**
     * LoanController constructor.
     *
     * @param LoanRepository $loanRepository
     */
    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return LoanCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new LoanCollection($this->loanRepository->getPaginated(25, 'id', 'asc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $loan = $this->loanRepository->create(array_add($request->only(
            'requested_value'
        ), 'user_id', $request->user()->id));

        //return res(201, __('alerts.frontend.loans.Requests.created'));
        return (new LoanResource($loan))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  \App\Models\Loan\Loan $loan
     * @return LoanResource|mixed
     */
    public function show(Request $request, Loan $loan)
    {
        return new LoanResource($loan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  \App\Models\Loan\Loan $loan
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, Loan $loan)
    {
        $loan = $this->loanRepository->update($loan, $request->only(
            'requested_value'
        ));

        //return res(200, __('alerts.frontend.loans.Requests.updated'));
        return (new LoanResource($loan))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan\Loan $loan
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(Request $request, Loan $loan)
    {
        $this->loanRepository->deleteById($loan->id);

        event(new LoanDeleted($loan));

//        __('alerts.frontend.loans.Requests.deleted')

        return res(200, 'Delete Successful');
    }
}

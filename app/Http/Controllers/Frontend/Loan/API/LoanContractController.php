<?php

namespace App\Http\Controllers\Frontend\Loan\API;

use App\Events\Frontend\Loan\LoanContractDeleted;
use App\Http\Requests\Frontend\Loan\API\DeleteLoanContractRequest;
use App\Http\Requests\Frontend\Loan\API\ListLoanContractRequest;
use App\Http\Requests\Frontend\Loan\API\StoreLoanContractRequest;
use App\Http\Requests\Frontend\Loan\API\UpdateLoanContractRequest;
use App\Http\Resources\Frontend\Loan\LoanContractCollection;
use App\Http\Resources\Frontend\Loan\LoanContractResource;
use App\Models\Loan\LoanContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Loan\LoanContractRepository;

class LoanContractController extends Controller
{
    /**
     * @var LoanContractRepository
     */
    protected $loanContractRepository;

    /**
     * LoanContractController constructor.
     *
     * @param LoanContractRepository $loanContractRepository
     */
    public function __construct(LoanContractRepository $loanContractRepository)
    {
        $this->loanContractRepository = $loanContractRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ListLoanContractRequest $request
     * @return LoanContractCollection|\Illuminate\Http\Response
     */
    public function index(ListLoanContractRequest $request)
    {
        return new LoanContractCollection($this->loanContractRepository->getOpenPaginated(25, 'id', 'asc'));
    }

    /*
     *
     */
    public function getByUserByStatus(Request $request, $userId){
//        return (new LoanContractResource(LoanContract::find($userId)))->additional([
//            'hello' => $request->query('q')
//        ]);
        return new LoanContractCollection($this->loanContractRepository
            ->getOpenPaginatedByUserByStatus(25, 'id', 'asc', $request->query('q'), $userId));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLoanContractRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(StoreLoanContractRequest $request)
    {
        $loanContract = $this->loanContractRepository->create($request->only(
            'consumer_id',
            'investor_id',
            'deal_origin_id',
            'deal_origin_type',
            'present_value',
            'period_type',
            'rate_per_period',
            'number_of_periods',
            'algorithm_type',
            'repayment_value',
            'status'
        ));

        //return res(201, __('alerts.frontend.loans.contracts.created'));
        return (new LoanContractResource($loanContract))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param ListLoanContractRequest $request
     * @param  \App\Models\Loan\LoanContract $loanContract
     * @return LoanContractResource|mixed
     */
    public function show(ListLoanContractRequest $request, LoanContract $loanContract)
    {
        return new LoanContractResource($loanContract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLoanContractRequest $request
     * @param  \App\Models\Loan\LoanContract $loanContract
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(UpdateLoanContractRequest $request, LoanContract $loanContract)
    {
        $loanContract = $this->loanContractRepository->update($loanContract, $request->only(
            'present_value',
            'period_type',
            'rate_per_period',
            'number_of_periods',
            'algorithm_type',
            'repayment_value',
            'status'
        ));

        //return res(200, __('alerts.frontend.loans.contracts.updated'));
        return (new LoanContractResource($loanContract))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan\LoanContract $loanContract
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(DeleteLoanContractRequest $request, LoanContract $loanContract)
    {
        $this->loanContractRepository->deleteById($loanContract->id);

        event(new LoanContractDeleted($loanContract));

//        __('alerts.frontend.loans.contracts.deleted')

        return res(200, 'Delete Successful');
    }
}

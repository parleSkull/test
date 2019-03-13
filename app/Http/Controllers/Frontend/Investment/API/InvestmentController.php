<?php

namespace App\Http\Controllers\Frontend\Investment\API;

use App\Events\Frontend\Investment\InvestmentDeleted;
use App\Http\Resources\Frontend\Investment\InvestmentCollection;
use App\Http\Resources\Frontend\Investment\InvestmentResource;
use App\Models\Investment\Investment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Loan\InvestmentRepository;

class InvestmentController extends Controller
{
    /**
     * @var InvestmentRepository
     */
    protected $investmentRepository;

    /**
     * InvestmentController constructor.
     *
     * @param InvestmentRepository $investmentRepository
     */
    public function __construct(InvestmentRepository $investmentRepository)
    {
        $this->investmentRepository = $investmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return InvestmentCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new InvestmentCollection($this->investmentRepository->getPaginated(25, 'id', 'asc'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $userId
     * @return InvestmentCollection|\Illuminate\Http\Response
     */
    public function byUser(Request $request, $userId)
    {
        return new InvestmentCollection($this->investmentRepository->getPaginatedByUser(25, 'id', 'asc', $userId));
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
        $investment = $this->investmentRepository->create(array_add($request->all(), 'user_id', $request->user()->id));

        //return res(201, __('alerts.frontend.loans.offers.created'));
        return (new InvestmentResource($investment))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  \App\Models\Investment\Investment $investment
     * @return InvestmentResource|mixed
     */
    public function show(Request $request, Investment $investment)
    {
        return new InvestmentResource($investment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  \App\Models\Investment\Investment $investment
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, Investment $investment)
    {
        $investment = $this->investmentRepository->update($investment, $request->only(
            'initial_value',
            'current_value',
            'interest_rate',
            'alias'
        ));

        //return res(200, __('alerts.frontend.loans.offers.updated'));
        return (new InvestmentResource($investment))->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment\Investment $investment
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function destroy(Request $request, Investment $investment)
    {
        $this->investmentRepository->deleteById($investment->id);

        event(new InvestmentDeleted($investment));

//        __('alerts.frontend.loans.offers.deleted')

        return res(200, 'Delete Successful');
    }
}

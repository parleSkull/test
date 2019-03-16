<?php

namespace App\Http\Controllers\Frontend\Fund\API;

use App\Http\Resources\Frontend\Fund\TransactionCollection;
use App\Http\Resources\Frontend\Fund\TransactionResource;
use App\Models\Fund\Transaction;
use App\Repositories\Frontend\Fund\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * TransactionController constructor.
     *
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $walletId
     * @return TransactionCollection|\Illuminate\Http\Response
     */
    public function byWallet(Request $request, $walletId)
    {
        return new TransactionCollection($this->transactionRepository->getPaginatedByWallet(25, 'id', 'asc', $walletId));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  \App\Models\FUnd\Transaction $transaction
     * @return TransactionResource|mixed
     */
    public function show(Request $request, Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }
}

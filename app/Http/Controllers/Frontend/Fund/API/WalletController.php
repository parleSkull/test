<?php

namespace App\Http\Controllers\Frontend\Fund\API;

use App\Http\Resources\Frontend\Fund\WalletResource;
use App\Models\Fund\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Fund\WalletRepository;

class WalletController extends Controller
{
    /**
     * @var WalletRepository
     */
    protected $walletRepository;

    /**
     * WalletRepository constructor.
     *
     * @param WalletRepository $walletRepository
     */
    public function __construct(WalletRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return WalletResource
     */
    public function byUser(Request $request)
    {
        return new WalletResource($request->user()->wallet);
    }

    /**
     * Deposit
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function deposit(Request $request)
    {
        $wallet = $this->walletRepository->deposit($request->user(),$request->input('amount', 0.00));

        return (new WalletResource($wallet))->response()->setStatusCode(200);
    }

    /**
     * Withdraw
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function withdraw(Request $request)
    {
        $wallet = $this->walletRepository->withdraw($request->user(),$request->input('amount', 0.00));

        return (new WalletResource($wallet))->response()->setStatusCode(200);
    }
}

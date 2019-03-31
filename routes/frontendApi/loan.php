<?php

use App\Http\Controllers\Frontend\Investment\API\InvestmentController;
use App\Http\Controllers\Frontend\Loan\API\LoanController;
use App\Http\Controllers\Frontend\Fund\API\WalletController;
use App\Http\Controllers\Frontend\Fund\API\TransactionController;
use App\Http\Controllers\Frontend\Fund\API\RequestPaymentController;
use App\Http\Controllers\Frontend\Fund\API\MpesaController;
use App\Http\Controllers\Frontend\Fund\API\MpesaCallbackController;

/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.api.loan'.
 */
Route::group(['namespace' => 'Loan\API', 'as' => 'loan.api.'], function () {

    /*
    * These routes require the user to be logged in
    */
    Route::group(['middleware' => 'auth:api'], function () {

        // Investment Resource
        Route::get('investments', [InvestmentController::class, 'index'])->name('investments.index');

        Route::get('users/{userId}/investments', [InvestmentController::class, 'byUser'])->name('investments.byUser');

        Route::get('investments/{investment}', [InvestmentController::class, 'show'])->name('investments.show');

        Route::post('investments', [InvestmentController::class, 'store'])->name('investments.store');

        Route::patch('investments/{investment}', [InvestmentController::class, 'update'])->name('investments.update');

        Route::delete('investments/{investment}', [InvestmentController::class, 'destroy'])->name('investments.destroy');

        // Loan Resource
        Route::get('loans', [LoanController::class, 'index'])->name('loans.index');

        Route::get('users/{userId}/loans', [LoanController::class, 'byUser'])->name('loans.byUser');

        Route::get('loans/{loan}', [LoanController::class, 'show'])->name('loans.show');

        Route::post('loans', [LoanController::class, 'store'])->name('loans.store');

        Route::patch('loans/{loan}', [LoanController::class, 'update'])->name('loans.update');

        Route::delete('loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');

        // Wallet Resource
        Route::get('wallets/by-user', [WalletController::class, 'byUser'])->name('wallets.byUser');

        Route::patch('wallets/deposit', [WalletController::class, 'deposit'])->name('wallets.deposit');

        Route::patch('wallets/withdraw', [WalletController::class, 'withdraw'])->name('wallets.withdraw');

        // Transaction Resource
        Route::get('wallets/{wallet}/transactions', [TransactionController::class, 'byWallet'])->name('transactions.byWallet');

        Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

        // Mobile Money
        Route::post('mtn/request-payment', [RequestPaymentController::class, 'requestPayment'])->name('mtn.requestPayment');
//        Route::post('mpesa/stk-push-callback', [MpesaController::class, 'processSTKPushQueryRequestCallback'])->name('mpesa.processSTKPushQueryRequestCallback');
        Route::post('mpesa/deposit', [MpesaController::class, 'deposit'])->name('mpesa.deposit');

    });

    /*
     * These routes do not require user to be logged in
     */

    Route::group(['middleware' => 'guest'], function () {
        Route::get('mpesa/stk-result', [MpesaCallbackController::class, 'processSTKPushRequestCallback'])->name('mpesa.processSTKPushRequestCallback');
    });
});

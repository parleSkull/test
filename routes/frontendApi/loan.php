<?php

use App\Http\Controllers\Frontend\Loan\API\LoanOfferController;
use App\Http\Controllers\Frontend\Loan\API\LoanRequestController;
/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.api.loan'.
 */
Route::group(['namespace' => 'Loan\API', 'as' => 'loan.api.'], function () {

    /*
    * These routes require the user to be logged in
    */
    Route::group(['middleware' => 'auth:api'], function () {

        // LoanOffer Resource
        Route::get('loan-offers', [LoanOfferController::class, 'index'])->name('loan-offers.index');

        Route::get('loan-offers/{loanOffer}', [LoanOfferController::class, 'show'])->name('loan-offers.show');

        Route::post('loan-offers', [LoanOfferController::class, 'store'])->name('loan-offers.store');

        Route::patch('loan-offers/{loanOffer}', [LoanOfferController::class, 'update'])->name('loan-offers.update');

        Route::delete('loan-offers/{loanOffer}', [LoanOfferController::class, 'destroy'])->name('loan-offers.destroy');

        // LoanRequest Resource
        Route::get('loan-requests', [LoanRequestController::class, 'index'])->name('loan-requests.index');

        Route::get('loan-requests/{loanRequest}', [LoanRequestController::class, 'show'])->name('loan-requests.show');

        Route::post('loan-requests', [LoanRequestController::class, 'store'])->name('loan-requests.store');

        Route::patch('loan-requests/{loanRequest}', [LoanRequestController::class, 'update'])->name('loan-requests.update');

        Route::delete('loan-requests/{loanRequest}', [LoanRequestController::class, 'destroy'])->name('loan-requests.destroy');
    });
});

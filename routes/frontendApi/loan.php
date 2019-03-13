<?php

use App\Http\Controllers\Frontend\Investment\API\InvestmentController;
use App\Http\Controllers\Frontend\Loan\API\LoanController;
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
    });
});

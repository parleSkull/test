<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class TransactionType extends Enum implements LocalizedEnum
{
    const Unspecified = "Unspecified";
    const Deposit = "Deposit";
    const Refund = "Refund";
    const Withdraw = "Withdraw";
    const LoanRepayment = "LoanRepayment";
    const ServiceCharge = "ServiceCharge";
    const Invest = "Invest";
    const InvestmentPayment = "InvestmentPayment";
    const LoanCredit = "LoanCredit";
}

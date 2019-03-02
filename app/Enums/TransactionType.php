<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class TransactionType extends Enum implements LocalizedEnum
{
    const Unspecified = 0;
    const Deposit = 1;
    const Refund = 2;
    const Withdraw = 3;
    const LoanRepayment = 4;
    const ServiceCharge = 5;    
}

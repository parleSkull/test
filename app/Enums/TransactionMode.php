<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionMode extends Enum
{
    const Debit = "Debit";
    const Credit = "Credit";
}

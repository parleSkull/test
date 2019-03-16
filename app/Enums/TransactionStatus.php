<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionStatus extends Enum
{
    const QUEUED = "QUEUED";
    const APPROVED = "APPROVED";
    const DECLINED = "DECLINED";
    const FAILED = "FAILED";
    const SUCCESS = "SUCCESS";
}

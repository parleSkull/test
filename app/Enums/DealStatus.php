<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DealStatus extends Enum
{
    const QUEUED = "QUEUED";
    const ACTIVE = "ACTIVE";
    const SETTLED = "SETTLED";
    const DISPUTED = "DISPUTED";
    const APPROVED = "APPROVED";
    const DECLINED = "DECLINED";
}

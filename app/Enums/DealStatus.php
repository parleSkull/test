<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DealStatus extends Enum
{
    const OPEN = "OPEN";
    const SETTLED = "SETTLED";
    const DISPUTED = "DISPUTED";
}

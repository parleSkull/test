<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PeriodType extends Enum
{
    const DAILY = "Daily";
    const WEEKLY = "Weekly";
    const MONTHLY = "Monthly";
    const YEARLY = "Yearly";
}

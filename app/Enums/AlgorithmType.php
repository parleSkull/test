<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AlgorithmType extends Enum
{
    /*
     * P = r(PV) / (1 - (1 + r)^-n)
     * P = Payment
     * PV = Present Value
     * r = rate per period
     * n = number of periods
     */
    const Standard = "Standard"; //standard loan amortized for a specific period of time with a fixed rate

    /*
     * P = r(PV) / (1 - (1 + r)^-n)
     * P = Payment
     * PV = Present Value
     * r = rate per period
     * n = number of periods
     */
    const Custom = 1; // user defined
}

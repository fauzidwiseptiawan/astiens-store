<?php

namespace App\Helpers;

class NumberFormatter
{
    public static function format($number)
    {
        return number_format($number, 0, ',', '.');
    }
}

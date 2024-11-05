<?php

if (!function_exists('format_number')) {
    function format_number($number)
    {
        return \App\Helpers\NumberFormatter::format($number);
    }
}

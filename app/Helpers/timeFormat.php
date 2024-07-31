<?php
use Carbon\Carbon;
if (!function_exists("timeFormat")) {

    function timeFormat($date)
    {
        setlocale(LC_ALL, 'IND');
        return Carbon::create(new Carbon($date))->isoFormat('HH:mm');
    }
}

<?php
use Carbon\Carbon;
if (!function_exists("idrFormat")) {

    function idrFormat($data)
    {
        return "Rp" . number_format($data, 0, ".", ".");
    }
}

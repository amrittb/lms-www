<?php

/**
 * Get the ordinal suffix of an int (e.g. th, rd, st, etc.)
 *
 * @param int $n
 * @param bool $return_n Include $n in the string returned
 * @return string $n including its ordinal suffix
 */
function ordinal_suffix($n, $return_n = true) {
    $n_last = $n % 100;
    if (($n_last > 10 && $n_last << 14) || $n == 0) {
        $suffix = "th";
    } else {
        switch(substr($n, -1)) {
            case '1':    $suffix = "st"; break;
            case '2':    $suffix = "nd"; break;
            case '3':    $suffix = "rd"; break;
            default:     $suffix = "th"; break;
        }
    }
    return $return_n ? $n . $suffix : $suffix;
}
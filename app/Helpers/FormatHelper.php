<?php

namespace App\Helpers;

class FormatHelper {
    public static function formatRupiah($number) {
        if ($number >= 1000000000000) {
            return 'Rp ' . number_format($number / 1000000000000, 2) . ' t';
        } elseif ($number >= 1000000000) {
            return 'Rp ' . number_format($number / 1000000000, 2) . ' m';
        } elseif ($number >= 1000000) {
            return 'Rp ' . number_format($number / 1000000, 2) . ' jt';
        } else {
            return 'Rp ' . number_format($number, 0);
        }
    }
}

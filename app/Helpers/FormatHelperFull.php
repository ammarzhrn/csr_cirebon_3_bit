<?php

namespace App\Helpers;

class FormatHelperFull
{
    public static function formatRupiahFull($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

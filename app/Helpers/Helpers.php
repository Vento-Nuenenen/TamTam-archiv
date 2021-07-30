<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helpers{
    public static function calc_birthday($persons, $personindex)
    {
        $carbon_birthday = Carbon::createFromFormat('Y-m-d', $persons[$personindex]->birthday);

        return $carbon_birthday->format('d.m.Y');
    }
}

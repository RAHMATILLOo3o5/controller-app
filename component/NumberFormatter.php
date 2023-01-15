<?php

namespace component;

use yii\base\Widget;

class NumberFormatter extends Widget
{

    public static function letterFormat($number)
    {
        if ($number !== null) {
            $suffix = '';
            if ($number >= 1e12) {
                $number /= 1e12;
                $suffix = 'T';
            } elseif ($number >= 1e9) {
                $number /= 1e9;
                $suffix = 'B';
            } elseif ($number >= 1e6) {
                $number /= 1e6;
                $suffix = 'M';
            } elseif ($number >= 1e3) {
                $number /= 1e3;
                $suffix = 'K';
            }
            return number_format($number, 1) . $suffix;
        } else{
            return 0;
        }
    }
}

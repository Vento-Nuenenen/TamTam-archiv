<?php

    namespace App\helper;

    class helper
    {
        public static function br2nl($str)
        {
            return str_replace('<br />', "\n", $str);
        }
    }

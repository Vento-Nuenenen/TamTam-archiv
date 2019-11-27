<?php

    namespace App\helper;

    class helper
    {
        public static function br2nl($str)
        {
            return str_replace('<br />', "\n", $str);
        }

        function generateBarcode($user_id) {
            try {
                $user = User::find($user_id);
                $user->barcode = mt_rand(000000000001, 999999999999);
                $user->save();

            } catch (Exception $e) {
                $error_info = $e->errorInfo;
                if($error_info[1] == 1062) {
                    generateBarcode($user_id);
                } else {
                    // Only logs when an error other than duplicate happens
                    Log::error($e);
                }

            }
        }
    }

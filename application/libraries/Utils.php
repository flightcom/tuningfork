<?php

use Cocur\Slugify\Slugify;

class Utils {

    public static function generateToken($length = 32)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    public static function generateBarcodeValue($type = null)
    {
        $systemNumber = 31;

        switch($type) {
            case 'ean13':
                $code = (string) $systemNumber
                    . str_pad( (string) rand(0, 99999), 5, "0", STR_PAD_LEFT)
                    . str_pad( (string) rand(0, 99999), 5, "0", STR_PAD_LEFT);
                $calcDigit = function () use ($code) {
                        $sum = 0;
                        foreach (str_split($code) as $key => $char) {
                            $sum += (($key % 2 == 0) ? 1 : 3) * (int) $char;
                        }
                        return (string) (10 - $sum % 10) % 10;
                    };
                $code .= $calcDigit();
                break;
            default:
                $code = '';
        }

        return $code;
    }

    public static function sanitizeQueryParams($queryParams)
    {
        $paramsToRemove = ['count', 'limit', 'order', 'asc', 'page'];
        return array_filter($queryParams, function ($key) use ($paramsToRemove) {
            return !in_array($key, $paramsToRemove);
        }, ARRAY_FILTER_USE_KEY);
    }

    public static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function slugify($text, $delimiter = '-')
    {
        $slugify = new Slugify();
        return $slugify->slugify($text, $delimiter);
    }

}


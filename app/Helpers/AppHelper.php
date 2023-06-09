<?php

use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Log;

if (!function_exists("camelCaseToSnakeCase")) {
    /**
     * @param $array
     * @return array
     */
    function camelCaseToSnakeCase($array)
    {
        $return = [];
        foreach ($array as $key => $value) {
            $return[strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $key))] = $value;
        }
        return $return;
    }
}
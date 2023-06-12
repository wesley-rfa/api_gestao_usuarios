<?php

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

if (!function_exists("responseNonModel")) {
    /**
     * Return a Json format response
     */
    function responseNonModel($data, $success = true, $statusCode = 200)
    {
        $response = new stdClass;
        $response->success = $success;
        $response->data = $data;

        $meta = new stdClass;
        $meta->apiVersion = env("API_VERSION");

        $response->meta = $meta;

        return response()->json($response, $statusCode);
    }
}

if (!function_exists("responseError")) {
    function responseError($request, $errorCodeEnum, $errors = [])
    {
        $response = new stdClass;
        $response->success = false;

        $data = new stdClass;

        $data->errorCode = $errorCodeEnum['errorCode'];
        $data->errorMessage = $errorCodeEnum['errorMessage'];
        $data->errorList = $errors;

        $response->data = $data;

        $meta = new stdClass;
        $meta->apiVersion = env("API_VERSION");

        $response->meta = $meta;

        return response()->json($response, $errorCodeEnum['statusCode']);
    }
}

if (!function_exists("responseEnveloper")) {

    function responseEnveloper(
        $type,
        $data = [],
        $errorList = [],
        $status = true,
        $errorCode = null,
        $errorMessage = "Generic Error",
        $includeData = false,
        $additionalInformation = []

    ) {
        $data       = $data != null ? $data : null;
        $errorList  = $errorList != null ? $errorList : null;

        $response           = new stdClass;
        $paginationOptions  = new stdClass;
        $meta               = new stdClass;
        $error              = new stdClass;
        $paginationLinks    = new stdClass;

        if ($status) {
            $response->success = $status;

            if ($data) {
                if ($data instanceof \Illuminate\Pagination\AbstractPaginator) {

                    $paginationOptions->totalPages      = $data->lastPage();
                    $paginationOptions->totalResults    = $data->total();
                    $paginationOptions->pageResults     = $data->count();
                    $paginationOptions->pageNumber      = $data->currentPage();
                    $paginationOptions->links           = $paginationLinks;

                    $meta->pagination = $paginationOptions;
                    $meta->apiVersion = env("API_VERSION");
                    $meta->additionalInformation = $additionalInformation;

                    $response->data  = dataToCamelCase($data);
                    $response->meta  = $meta;
                } else {
                    $response->data = dataToCamelCase($data);
                    $meta->apiVersion = env("API_VERSION");
                    $meta->additionalInformation = $additionalInformation;

                    $response->meta = $meta;
                }
            }
        } else {

            $error->errorCode = $errorCode;
            $error->errorMessage = $errorMessage;
            $error->errorList = $errorList;

            $meta->apiVersion = env("API_VERSION");
            $meta->additionalInformation = $additionalInformation;

            $response->success = $status;
            $response->data = $error;
            $response->meta = $meta;
        }
        return json_encode($response);
    }
}

if (!function_exists("dataToCamelCase")) {
    function dataToCamelCase($array)
    {
        $array = $array->toArray();
        foreach ($array as $dataKey => $data) {
            if (is_numeric($dataKey)) {
                foreach ($data as $field => $dataValue) {
                    if (is_numeric($field)) {
                        foreach ($dataValue as $field2 => $dataValue2) {
                            $array[$dataKey][snakeCaseToCamelCase($field2)] = $dataValue2;
                            if ($field2 !== snakeCaseToCamelCase($field2)) unset($array[$dataKey][$field2]);
                        }
                    } else {
                        if (is_array($dataValue)) {
                            foreach ($dataValue as $field2 => $dataValue2) {
                                if (is_numeric($field2)) {
                                    foreach ($dataValue2 as $field3 => $dataValue3) {
                                        $dataValue[$field2][snakeCaseToCamelCase($field3)] = $dataValue3;
                                        if ($field3 !== snakeCaseToCamelCase($field3)) unset($dataValue[$field2][$field3]);
                                    }
                                } else {
                                    $dataValue[snakeCaseToCamelCase($field2)] = $dataValue2;
                                    if ($field2 !== snakeCaseToCamelCase($field2)) unset($dataValue[$field2]);
                                }
                            }
                        }
                        $array[$dataKey][snakeCaseToCamelCase($field)] = $dataValue;
                        if ($field !== snakeCaseToCamelCase($field)) unset($array[$dataKey][$field]);
                    }
                }
            } else {
                $array[snakeCaseToCamelCase($dataKey)] = $data;
                if ($dataKey !== snakeCaseToCamelCase($dataKey)) unset($array[$dataKey]);
            }
        }
        return $array;
    }
}

if (!function_exists("snackCaseToCamelCase")) {
    function snakeCaseToCamelCase($string, $noStrip = [])
    {
        $string = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $string);
        $string = trim($string);

        $string = ucwords($string);
        $string = str_replace(" ", "", $string);
        $string = lcfirst($string);

        return $string;
    }
}

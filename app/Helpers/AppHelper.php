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

                    $response->data  = $data;
                    $response->meta  = $meta;
                } else {
                    $response->data = $data;
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

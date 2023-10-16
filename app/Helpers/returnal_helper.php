<?php

function format_return($success = true, string $message = '', $data = null, $pagination = null)
{
    $response = [
        'success' => $success,
        'message' => $message,
    ];

    if ($data) {
        if ($pagination) {
            $responseData = [
                'data' => $data,
                'pagination' => $pagination
            ];
        } else {
            $responseData = [
                'data' => $data,
            ];
        }
     
        $response = array_merge($response, $responseData);
    }

    return $response;
}

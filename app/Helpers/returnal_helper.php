<?php

function format_return(string $message = '', $data = null, $pagination = null)
{
    $response = [
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

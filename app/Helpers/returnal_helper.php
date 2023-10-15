<?php

function format_return($success = true, string $message = '', $data = null)
{
    $response = [
        'success' => $success,
        'message' => $message,
    ];

    if ($data) {
        $responseData = [
            'data' => $data
        ];

        $response = array_merge($response, $responseData);
    }

    return $response;
}

<?php

function format_return($success = true, string $message = '', $data = null, $pager = null)
{
    $response = [
        'success' => $success,
        'message' => $message,
    ];

    if ($data) {
        if ($pager) {
            $responseData = [
                'data' => $data,
                'pager' => $pager
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

<?php

function returnal($success = true, string $message = '', $data = null)
{
    $response = [
        'success' => $success,
        'message' => $message,
        'data' => $data
    ];

    return $response;
}

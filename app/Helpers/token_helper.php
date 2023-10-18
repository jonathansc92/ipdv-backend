<?php

use \Firebase\JWT\JWT;

function getToken(string $email, int $expirationAt = 3600)
{
    $key = getenv('JWT_SECRET');
    $iat = time();
    $exp = $iat + $expirationAt;

    $payload = array(
        "iss" => "Issuer of the JWT",
        "aud" => "Audience that the JWT",
        "sub" => "Subject of the JWT",
        "iat" => $iat,
        "exp" => $exp,
        "email" => $email,
    );

    return JWT::encode($payload, $key, 'HS256');
}

<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use \Firebase\JWT\JWT;

class LoginController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $rules = $this->validate(([
            'email' => 'required',
            'password' => 'required',
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $userModel = new UserModel();

        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if (is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], Response::HTTP_UNAUTHORIZED);
        }

        $pwd_verify = password_verify($this->request->getVar('password'), $user['password']);

        if (!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], Response::HTTP_UNAUTHORIZED);
        }

        $key = 'JWT_SECRET';
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );

        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];

        return $this->respond($response, 200);
    }
}

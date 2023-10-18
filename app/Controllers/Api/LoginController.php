<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

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
            return $this->respond(format_return(false, ERROR), Response::HTTP_UNAUTHORIZED);
        }

        $pwd_verify = password_verify($this->request->getVar('password'), $user['password']);

        if (!$pwd_verify) {
            return $this->respond(format_return(false, ERROR), Response::HTTP_UNAUTHORIZED);
        }

        $response = [
            'message' => SUCCESS,
            'token' => getToken($user['email'])
        ];

        return $this->respond($response, 200);
    }
}

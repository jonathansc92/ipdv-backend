<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

class AuthController extends BaseController
{
    use ResponseTrait;

    private function rules()
    {
        $rules = $this->validate(([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[4]|max_length[255]',
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }
    }

    public function login()
    {
        $rules = $this->rules();

        if ($rules) {
            return $rules;
        }

        $userModel = new UserModel();

        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if (is_null($user)) {
            return $this->respond(format_return(UNAUTHORIZED), Response::HTTP_UNAUTHORIZED);
        }

        $pwd_verify = password_verify($this->request->getVar('password'), $user['password']);

        if (!$pwd_verify) {
            return $this->respond(format_return(UNAUTHORIZED), Response::HTTP_UNAUTHORIZED);
        }

        return $this->respond(format_return(LOGIN_SUCCESS, [
            'token' => getToken($user['email'])
        ]));
    }
}

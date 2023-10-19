<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

class RegisterController extends BaseController
{
    use ResponseTrait;

    private function data(): array
    {
        return [
            'name'    => $this->request->getVar('name'),
            'department_id'    => $this->request->getVar('department_id'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
    }

    private function rules()
    {
        $rules = $this->validate(([
            'name' => ['rules' => 'required'],
            'department_id' => ['rules' => 'required'],
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => ['label' => 'confirm password', 'rules' => 'matches[password]']
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }
    }

    public function index()
    {
        if ($this->rules()) {
            return $this->rules();
        }

        $model = new UserModel();
        $model->save($this->data());

        return $this->respond(format_return(CREATED), Response::HTTP_CREATED);
    }
}

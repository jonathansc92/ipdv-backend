<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

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
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
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
        $perPage = $this->request->getGet('per_page') ?: PER_PAGE;
        $page = (int) $this->request->getGet('page') ?: PAGE;

        $users = $this->model->usersDepartment()->paginate($perPage, 'group1', $page);

        $pagination = getPagination($this->model);

        if ($users) {
            $data = format_return(SUCCESS, $users, $pagination);
            $statusCode = Response::HTTP_OK;
        } else {
            $data = format_return(NOT_FOUND, $users);
            $statusCode = Response::HTTP_NOT_FOUND;
        }

        return $this->respond($data, $statusCode);
    }

    public function show($id = null)
    {
        $user = $this->model->usersDepartment()->find($id);

        if (!$user) {
            return $this->failNotFound(NOT_FOUND);
        }

        return $this->respond(format_return(SUCCESS, $user));
    }

    public function create()
    {
        if ($this->rules()) {
            return $this->rules();
        }

        $user = $this->model->insert($this->data(), true);

        if ($user) {
            return $this->respondCreated(format_return(CREATED, $this->model->usersDepartment()->find($user)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null)
    {
        if ($this->rules()) {
            return $this->rules();
        }

        $user = $this->model->update($id, $this->data());

        if ($user) {
            return $this->respondUpdated(format_return(UPDATED, $this->model->usersDepartment()->find($id)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        return $this->respondDeleted(format_return(DELETED));
    }
}

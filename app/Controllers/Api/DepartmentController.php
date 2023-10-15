<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class DepartmentController extends ResourceController
{

    protected $modelName = 'App\Models\DepartmentModel';
    protected $format = 'json';

    public function index()
    {
        $data = format_return(true, SUCCESS, $this->model->paginate());

        return $this->respond($data, Response::HTTP_OK);
    }

    public function show($id = null)
    {
        $department = $this->model->find($id);

        if (!$department) {
            return $this->failNotFound(NOT_FOUND);
        }

        return $this->respond(format_return(true, SUCCESS, $department));
    }

    public function create()
    {
        $rules = $this->validate(([
            'description' => 'required',
            'cost_center_id' => 'required',
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $data = [
            'description' => $this->request->getVar('description'),
            'cost_center_id' => $this->request->getVar('cost_center_id'),
        ];

        $department = $this->model->insert($data, false);

        if ($department) {
            return $this->respondCreated(format_return($department, CREATED));
        }

        return $this->respond(format_return(false, ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null)
    {
        $rules = $this->validate(([
            'description' => 'required',
            'cost_center_id' => 'required',
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $data = [
            'description' => $this->request->getVar('description'),
            'cost_center_id' => $this->request->getVar('cost_center_id'),
        ];

        $department = $this->model->update($id, $data);

        if ($department) {
            return $this->respondUpdated(format_return($department, UPDATED));
        }

        return $this->respond(format_return(false, ERROR), Response::HTTP_FORBIDDEN);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        return $this->respondDeleted(format_return(true, DELETED));
    }
}

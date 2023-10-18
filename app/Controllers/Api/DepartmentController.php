<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class DepartmentController extends ResourceController
{

    protected $modelName = 'App\Models\DepartmentModel';
    protected $format = 'json';
    private function data(): array
    {
        return [
            'description' => $this->request->getVar('description'),
            'cost_center_id' => $this->request->getVar('cost_center_id'),
        ];
    }

    private function rules()
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
    }

    public function index()
    {
        $perPage = $this->request->getGet('per_page') ?: PER_PAGE;
        $page = (int) $this->request->getGet('page') ?: PAGE;

        $departments = $this->model->paginate($perPage, 'group1', $page);

        if ($this->request->getGet('cost_centers')) {
            $departments = $this->model->where('cost_center_id', $this->request->getGet('cost_centers'))->paginate($perPage);
        }

        $pagination = getPagination($this->model);

        if ($departments) {
            $data = format_return(true, SUCCESS, $departments, $pagination);
        } else {
            $data = format_return(false, NOT_FOUND, $departments);
        }

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
        if ($this->rules()) {
            return $this->rules();
        }

        $department = $this->model->insert($this->data(), false);

        if ($department) {
            return $this->respondCreated(format_return($department, CREATED));
        }

        return $this->respond(format_return(false, ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null)
    {
        if ($this->rules()) {
            return $this->rules();
        }

        $department = $this->model->update($id, $this->data());

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

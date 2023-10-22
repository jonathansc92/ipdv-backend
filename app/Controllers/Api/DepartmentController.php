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
        $description = $this->request->getVar('description');
        $costCenterId = $this->request->getVar('cost_center_id');

        if (isset($description) && !empty($description)) {
            $data['description'] = $description;
        }

        if (isset($costCenterId) && !empty($costCenterId)) {
            $data['cost_center_id'] = $costCenterId;
        }

        return $data;
    }

    private function rules($id = null)
    {
        $rules = $this->validate(([
            'description' => [
                'label' => 'descrição',
                'rules' => $id ? 'if_exist' : 'required' . '|max_length[50]'
            ],
            'cost_center_id' => [
                'label' => 'centro de custo id',
                'rules' => 'if_exist|integer'
            ]
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

        $departments = $this->model->departmentsWithCost()->paginate($perPage, 'group1', $page);

        if ($this->request->getGet('cost_centers')) {
            $departments = $this->model->departmentsWithCost()->where('cost_center_id', $this->request->getGet('cost_centers'))->paginate($perPage);
        }

        $pagination = getPagination($this->model);

        if ($departments) {
            $data = format_return(SUCCESS, $departments, $pagination);
        } else {
            $data = format_return(NOT_FOUND, $departments);
        }

        return $this->respond($data, Response::HTTP_OK);
    }

    public function show($id = null)
    {
        $department = $this->model->departmentsWithCost()->find($id);

        if (!$department) {
            return $this->failNotFound(NOT_FOUND);
        }

        return $this->respond(format_return(SUCCESS, $department));
    }

    public function create()
    {
        $rules = $this->rules();

        if ($rules) {
            return $rules;
        }

        $department = $this->model->insert($this->data(), true);

        if ($department) {
            return $this->respondCreated(format_return(CREATED, $this->model->departmentsWithCost()->find($department)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null)
    {
        $rules = $this->rules($id);

        if ($rules) {
            return $rules;
        }

        $department = $this->model->update($id, $this->data());

        if ($department) {
            return $this->respondUpdated(format_return(UPDATED, $this->model->departmentsWithCost()->find($id)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        return $this->respondDeleted(format_return(DELETED));
    }
}

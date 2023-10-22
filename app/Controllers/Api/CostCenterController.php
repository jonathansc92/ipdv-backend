<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class CostCenterController extends ResourceController
{
    protected $modelName = 'App\Models\CostCenterModel';
    protected $format = 'json';

    private function data(): array
    {
        $description = $this->request->getVar('description');

        if (isset($description) && !empty($description)) {
            $data['description'] = $description;
        }

        return $data;
    }

    private function rules($id = null)
    {
        $rules = $this->validate(([
            'description' => [
                'label' => 'descrição',
                'rules' => $id ? 'if_exist' : 'required' . '|max_length[50]'
            ]
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }
    }

    public function index(): Response
    {
        $perPage = (int) $this->request->getGet('per_page') ?: PER_PAGE;
        $page = (int) $this->request->getGet('page') ?: PAGE;

        $costCenters = $this->model->paginate($perPage, 'group1', $page);

        $pagination = getPagination($this->model);

        $data = format_return(SUCCESS, $costCenters, $pagination);

        return $this->respond($data, Response::HTTP_OK);
    }

    public function show($id = null): Response
    {
        $costCenter = $this->model->find($id);

        if (!$costCenter) {
            return $this->failNotFound(NOT_FOUND);
        }

        return $this->respond(format_return(SUCCESS, $costCenter));
    }

    public function create(): Response
    {
        $rules = $this->rules();

        if ($rules) {
            return $rules;
        }

        $costCenter = $this->model->insert($this->data(), true);

        if ($costCenter) {
            return $this->respondCreated(format_return(CREATED, $this->model->find($costCenter)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null): Response
    {
        $rules = $this->rules($id);

        if ($rules) {
            return $rules;
        }

        $costCenter = $this->model->update($id, $this->data());

        if ($costCenter) {
            return $this->respondUpdated(format_return(UPDATED, $this->model->find($id)));
        }

        return $this->respond(format_return(ERROR), Response::HTTP_FORBIDDEN);
    }

    public function delete($id = null): Response
    {
        $this->model->delete($id);

        return $this->respondDeleted(format_return(DELETED));
    }
}

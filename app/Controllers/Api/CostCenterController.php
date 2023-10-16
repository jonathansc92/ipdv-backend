<?php

namespace App\Controllers\Api;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class CostCenterController extends ResourceController
{

    protected $modelName = 'App\Models\CostCenterModel';
    protected $format = 'json';

    public function index()
    {
        $perPage = (int) $this->request->getGet('per_page') ?: PER_PAGE;
        $page = (int) $this->request->getGet('page') ?: PAGE;
        
        $costCenters = $this->model->paginate($perPage, 'group1', $page);

        $pagination = getPagination($this->model);
        
        $data = format_return(true, SUCCESS, $costCenters, $pagination);

        return $this->respond($data, Response::HTTP_OK);
    }

    public function show($id = null)
    {
        $costCenter = $this->model->find($id);

        if (!$costCenter) {
            return $this->failNotFound(NOT_FOUND);
        }

        return $this->respond(format_return(true, SUCCESS, $costCenter));
    }

    public function create()
    {
        $rules = $this->validate(([
            'description' => 'required'
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $data = [
            'description' => $this->request->getVar('description'),
        ];

        $costCenter = $this->model->insert($data, false);

        if ($costCenter) {
            return $this->respondCreated(format_return($costCenter, CREATED));
        }

        return $this->respond(format_return(false, ERROR), Response::HTTP_FORBIDDEN);
    }

    public function update($id = null)
    {
        $rules = $this->validate(([
            'description' => 'required'
        ]));

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $data = [
            'description' => $this->request->getVar('description'),
        ];

        $costCenter = $this->model->update($id, $data);

        if ($costCenter) {
            return $this->respondUpdated(format_return($costCenter, UPDATED));
        }

        return $this->respond(format_return(false, ERROR), Response::HTTP_FORBIDDEN);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        return $this->respondDeleted(format_return(true, DELETED));
    }
}

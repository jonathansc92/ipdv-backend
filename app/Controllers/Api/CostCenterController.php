<?php

namespace App\Controllers\Api;

use App\Models\CostCenterModel;
use CodeIgniter\RESTful\ResourceController;
use App\Services\CostCenterService;

class CostCenterController extends ResourceController
{

    protected $model;

    public function __construct()
    {
        $this->model = new CostCenterModel();
    }

    public function get()
    {
        $costCenterData = $this->model->paginate();

        $return = returnal(true, 'Centro de Custos recuperados com sucesso!', $costCenterData);

        return $this->respond($return);
    }

    public function show($id = null)
    {
        //
    }

    public function create()
    {
        $data = [
            'description' => $this->request->getVar('description')
        ];

        $this->model->insert($data);

        return returnal(true, 'Centro de Custos adicionado com sucesso!', $this->model);
    }

    public function update($id = null)
    {
        //
    }

    public function delete($id = null)
    {
        //
    }
}

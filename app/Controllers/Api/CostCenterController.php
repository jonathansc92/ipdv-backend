<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Services\CostCenterService;

class CostCenterController extends ResourceController
{

    public function get()
    {
        return $this->respond(CostCenterService::get());
    }

    public function show($id = null)
    {
        //
    }

    public function create()
    {
        //
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

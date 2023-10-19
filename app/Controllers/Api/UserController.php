<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;

class UserController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        $perPage = $this->request->getGet('per_page') ?: PER_PAGE;
        $page = (int) $this->request->getGet('page') ?: PAGE;

        $model = new UserModel;

        $users = $model->select('id, name, email, created_at')->paginate($perPage, 'group1', $page);

        $pagination = getPagination($model);

        if ($users) {
            $data = format_return(SUCCESS, $users, $pagination);
            $statusCode = Response::HTTP_OK;
        } else {
            $data = format_return(NOT_FOUND, $users);
            $statusCode = Response::HTTP_NOT_FOUND;
        }

        return $this->respond($data, $statusCode);
    }
}

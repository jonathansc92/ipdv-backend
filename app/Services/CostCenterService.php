<?php


namespace App\Services;

use App\Models\CostCenterModel;

class CostCenterService
{
    public static function get()
    {
        $costCenter = new CostCenterModel();

        $costCenterData = $costCenter->paginate();

        return returnal(true, 'Centro de Custos recuperados com sucesso!', $costCenterData);
    }
}
<?php

namespace restapi\controllers;

use restapi\controllers\BaseController;
use restapi\modules\seller\models\DebtorModel;


class DebtorController extends BaseController
{
    public $modelClass = DebtorModel::class;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }
}
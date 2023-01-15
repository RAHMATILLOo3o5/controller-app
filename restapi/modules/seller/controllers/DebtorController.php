<?php

namespace restapi\modules\seller\controllers;

use restapi\controllers\BaseController;
use restapi\modules\seller\models\DebtorModel;


class DebtorController extends BaseController
{
    public $modelClass = DebtorModel::class;
}
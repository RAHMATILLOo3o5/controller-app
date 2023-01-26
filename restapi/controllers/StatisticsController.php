<?php

namespace restapi\controllers;

use common\models\Statistics;

class StatisticsController extends BaseController
{
    public $modelClass = Statistics::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        return $actions;
    }
}
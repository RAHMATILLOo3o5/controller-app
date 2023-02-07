<?php

namespace restapi\controllers;

use common\models\Selling;
use restapi\models\SellingModel;
use yii\data\ActiveDataProvider;

class SellingController extends BaseController
{
    public $modelClass = SellingModel::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['delete'], $actions['view'], $actions['update']);

        return $actions;
    }


    public function actionList($worker_id)
    {
        
        $selling = SellingModel::find()->where(['worker_id' => $worker_id])->all();

        return $selling;
    }

}
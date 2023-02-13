<?php

namespace restapi\controllers;

use restapi\models\SellingModel;
use Yii;

class SellingController extends BaseController
{
    public $modelClass = SellingModel::class;

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['delete'], $actions['view'], $actions['update']);

        return $actions;
    }


    public function actionList()
    {
        $params = Yii::$app->request->get();
        $selling = SellingModel::find();
        if (isset($params['worker_id']) && isset($params['product_id'])) {

            $selling->where(['worker_id' => $params['worker_id'], 'product_id' => $params['product_id']]);

        } else if (isset($params['worker_id'])) {

            $selling->where(['worker_id' => $params['worker_id']]);

        } else if (isset($params['product_id'])) {

            $selling->where(['product_id' => $params['product_id']]);

        } 
        return $selling->orderBy(['id' => SORT_DESC])->all();
    }
}

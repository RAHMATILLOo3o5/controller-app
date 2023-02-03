<?php

namespace restapi\modules\seller\controllers;

use restapi\controllers\ProductController;
use restapi\models\ProductModel;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
class SellerProductController extends ProductController
{
    public $modelClass = ProductModel::class;

    public $serializer = [
        'class' => Serializer::class,
    ];

    public function actions()
    {
        $action = parent::actions();

        unset($action['create']);
        unset($action['update']);
        unset($action['index']);
        return $action;
    }

    public function actionIndex($category_id)
    {
        $data = new ActiveDataProvider([
            'query' => ProductModel::find()->where(['category_id' => $category_id, 'status' => ProductModel::STATUS_ACTIVE]),
            'pagination' => false
        ]);

        return $data;
    }
}

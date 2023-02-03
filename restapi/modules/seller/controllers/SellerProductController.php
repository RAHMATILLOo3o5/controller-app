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
        $action['index']['prepareDataProvider'] = [$this, 'dataProvider'];
        return $action;
    }

    public function dataProvider()
    {
        $data = new ActiveDataProvider([
            'query' => ProductModel::find(),
            'pagination' => false
        ]);

        return $data;
    }
}
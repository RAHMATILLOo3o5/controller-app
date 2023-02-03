<?php

namespace restapi\modules\seller\controllers;

use restapi\controllers\CategoryController;
use restapi\models\CategoryModel;
use yii\rest\Serializer;
use yii\data\ActiveDataProvider;


class SellerProductCategoryController extends CategoryController
{
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
            'query' => CategoryModel::find(),
            'pagination' => false
        ]);

        return $data;
    }
}

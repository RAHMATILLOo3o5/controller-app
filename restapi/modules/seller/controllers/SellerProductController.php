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

    public function actionIndex()
    {
        $category_id = Yii::$app->request->get('category_id');
        if (!$category_id) {
            $data = new ActiveDataProvider([
                'query' => ProductModel::find()->andWhere(['status' => ProductModel::STATUS_ACTIVE]),
                'pagination' => false
            ]);
        }else{
            $data = new ActiveDataProvider([
                'query' => ProductModel::find()->andWhere(['status' => ProductModel::STATUS_ACTIVE])->andWhere(['category_id' => $category_id]),
                'pagination' => false
            ]);
        }


        return $data;
    }
}

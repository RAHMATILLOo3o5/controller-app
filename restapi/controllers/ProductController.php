<?php

namespace restapi\controllers;

use restapi\models\ProductModel;
use Yii;
use yii\helpers\VarDumper;

class ProductController extends BaseController
{

    public $modelClass = ProductModel::class;


    public function actions()
    {
        $action = parent::actions();

        unset($action['create']);

        return $action;
    }

    public function actionCreate()
    {
        $model = new ProductModel();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post(), '')) {
            $model->status = $model::STATUS_ACTIVE;
            $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);

            return ($model->save()) ? $model : null;
        } else {
            return $model->errors;
        }
    }
}

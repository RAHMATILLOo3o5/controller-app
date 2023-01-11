<?php

namespace restapi\controllers;

use restapi\models\ProductModel;
use Yii;
use yii\helpers\VarDumper;

class ProductController extends BaseController{

    public $modelClass = ProductModel::class;


    public function actions()
    {
        $action = parent::actions();

        unset($action['create']);

        return $action;
    }

    public function actionCreate() {
        $model = new ProductModel();

        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            VarDumper::dump($model);
            return false;
        } else{
            VarDumper::dump($model->errors);
            return false;
        }
        
    }

}
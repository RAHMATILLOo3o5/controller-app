<?php

namespace restapi\modules\seller\controllers;

use common\models\Backlog;
use common\models\Selling;
use restapi\controllers\BaseController;
use restapi\modules\seller\models\SellingDebt;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\MethodNotAllowedHttpException;

class SellingController extends BaseController
{
    public $modelClass = Selling::class;

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['prepareDataProvider'] = [$this, 'data'];

        return $actions;
    }

    public function actionSellingDebt()
    {
        $model = new SellingDebt();
        if (Yii::$app->request->isPost) {
            if($model->load($this->request->post(), '') && $model->validate()){
                return $model;
            } else{
                return $model->errors;
            }
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }

    public function data()
    {
        $provider = new ActiveDataProvider([
            'query' => Selling::find()->where(['worker_id' => Yii::$app->user->id])
        ]);
        return $provider;
    }

}
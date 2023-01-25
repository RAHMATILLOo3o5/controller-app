<?php

namespace restapi\modules\seller\controllers;

use common\models\Selling;
use restapi\controllers\BaseController;
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

    public function data()
    {
        $provider = new ActiveDataProvider([
            'query' => Selling::find()->where(['worker_id' => Yii::$app->user->id])
        ]);
        return $provider;
    }

}
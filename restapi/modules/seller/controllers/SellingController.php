<?php

namespace restapi\modules\seller\controllers;

use common\models\Backlog;
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

    public function actionSellingDebt()
    {
        $model = new Selling();
        $backlog = new Backlog();
        if (Yii::$app->request->isPost) {
            if ($backlog->load(Yii::$app->request->post(), '') && $model->load(Yii::$app->request->post(), '')) {
                $model->type_pay = Selling::PAY_DEBT;
                $model->save();
                $backlog->selling_id = $model->id;
                if ($backlog->save()) {
                    return $backlog->saved();
                } else {
                    return [
                        $backlog->errors,
                        $model->errors
                    ];
                }
            } else {
                return [
                    $backlog->errors,
                    $model->errors
                ];
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
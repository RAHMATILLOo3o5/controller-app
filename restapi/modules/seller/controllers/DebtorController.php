<?php

namespace restapi\modules\seller\controllers;

use common\models\DebtAmount;
use common\models\Debtor;
use restapi\controllers\BaseController;
use restapi\modules\seller\models\DebtorModel;
use yii\web\MethodNotAllowedHttpException;


class DebtorController extends BaseController
{
    public $modelClass = DebtorModel::class;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $model = new DebtorModel();
        $debt = new DebtAmount();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '')) {
                $model->status = $model::ACTIVE;
                $model->save();
                $debt->debtor_id = $model->id;
                $debt->all_debt_amount = 0;
                $debt->pay_debt = 0;
                $debt->save();
                return $model;
            } else{
                return $model->errors;
            }
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }

    }
}
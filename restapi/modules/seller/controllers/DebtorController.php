<?php

namespace restapi\modules\seller\controllers;

use common\models\Backlog;
use common\models\DebtAmount;
use restapi\controllers\BaseController;
use restapi\modules\seller\models\DebtorModel;
use restapi\modules\seller\models\PayDebt;
use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class DebtorController extends BaseController
{
    public $modelClass = DebtorModel::class;

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['view']);
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
            } else {
                return $model->errors;
            }
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }

    public function actionView($id)
    {
        if ($id != null) {
            $model = DebtorModel::findOne($id);
            $debt = DebtAmount::findOne(['debtor_id' => $id]);
            $debt_list = Backlog::findAll(['debtor_id' => $id]);
            return [
                'debtor' => $model,
                'debt_amount' => $debt,
                'debt_list' => $debt_list
            ];
        } else {
            throw new NotFoundHttpException("Ma'lumot topilmadi!");
        }
    }

    public function actionPayDebt($debtor_id)
    {
        $model = new PayDebt();
        $debtor = DebtorModel::findOne($debtor_id);
        if (Yii::$app->request->isPost && $model->load($this->request->post(), '')) {
            return $model->saved($debtor_id);
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }
}

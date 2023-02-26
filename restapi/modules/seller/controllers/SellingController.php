<?php

namespace restapi\modules\seller\controllers;

use common\models\Selling;
use restapi\controllers\BaseController;
use restapi\models\SellingModel;
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
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'data'];

        return $actions;
    }

    public function actionCreate()
    {
        $model = new SellingModel();
        if (Yii::$app->request->isPost) {
            $productList = $this->request->post('productList');
            $type_pay = $this->request->post('type_pay');
            return $model->saved($productList, $type_pay);
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }

    public function actionSellingDebt()
    {
        $model = new SellingDebt();
        if (Yii::$app->request->isPost) {
            $sellingList = $this->request->post('productList');
            $debtorData = $this->request->post('debtorData');
            $total_debt = $this->request->post('total_debt');
            $instant_payment = $this->request->post('instant_payment');
            $isCreate = $this->request->post('isCreate');
            if ($isCreate) {
                return $model->saveWithDebtor($sellingList, $debtorData, $total_debt, $instant_payment);
            }
            return $model->saveWithoutDebtor($sellingList, $debtorData, $total_debt, $instant_payment);
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

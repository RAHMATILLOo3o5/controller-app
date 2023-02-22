<?php

namespace restapi\modules\seller\controllers;

use restapi\models\SellingModel;
use restapi\modules\seller\models\DebtorModel;
use yii\rest\Controller;

class OrderController extends Controller
{
    public $defaultAction = 'order';
    /**
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,

        ];

        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        return $behaviors;
    }
     */
    public function actionOrder()
    {
        $data = [];
        $data['order'] = SellingModel::find()->orderBy(['id' => SORT_ASC])->all();
        $data['debtors'] = DebtorModel::find()->orderBy(['id' => SORT_ASC])->all();
        return $data;
    }
}

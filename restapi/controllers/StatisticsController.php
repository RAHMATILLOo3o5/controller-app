<?php

namespace restapi\controllers;

use common\models\Statistics;
use Yii;
use yii\data\ActiveDataProvider;

class StatisticsController extends BaseController
{
    public $modelClass = Statistics::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        $actions['index']['prepareDataProvider'] = [$this, 'data'];
        return $actions;
    }

    public function data()
    {
        $period = Yii::$app->request->get('period');
        $data = new ActiveDataProvider([
            'query' => Statistics::find()->where(['>=', 'period', date('Y-m-d H:i', strtotime("-{$period} days"))]),
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        return $data;
    }
}
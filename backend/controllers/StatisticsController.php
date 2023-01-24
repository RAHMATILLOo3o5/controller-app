<?php

namespace backend\controllers;

use common\models\Statistics;
use console\controllers\ReportCommand;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatisticsController implements the CRUD actions for Statistics model.
 */
class StatisticsController extends BaseController
{
    /**
     * Lists all Statistics models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $period = Yii::$app->request->get('period');
        $dataProvider = new ActiveDataProvider([
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
        $model = new Statistics();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionStatCreate()
    {
        $report = new Statistics();
        if($report->saveDataToDB()){
            return true;
        } else{
            return false;
        }
    }
}

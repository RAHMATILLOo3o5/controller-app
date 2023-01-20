<?php

namespace console\controllers;

use common\models\OtherSpent;
use common\models\Product;
use common\models\Selling;
use common\models\Statistics;
use Yii;
use yii\console\Controller;

class ReportCommand extends Controller
{
    public function actionRun()
    {
        return $this->saveDataToDB();
    }

    public function saveDataToDB()
    {
        $ledgerData = $this->calculateData();
        return Yii::$app->db->createCommand()->batchInsert('statistics', ['period', 'total_spent', 'total_benifit', 'benifit', 'differrents', 'created_at'], [$ledgerData])->execute();
    }

    public function calculateData()
    {
        $productSpent = new Product();
        $otherSpent = new OtherSpent();
        $profit = new Selling();
        $diff = Statistics::find()->count();
        $data['period'] = date("Y-m-d H:i");
        $data['total_spent'] = $otherSpent->allSumm + $productSpent->allMoney;
        $data['total_benifit'] = $profit->allMoney;
        $data['benifit'] = $data['total_benifit'] - $data['total_spent'];
        $diff = Statistics::find()->orderBy('id', SORT_DESC)->one();
        if ($diff === 0) {
            $data['differrents'] = 0;
        } else{
            $diff = Statistics::find()->orderBy('id', SORT_DESC)->one();
            $data['differrents'] = $diff->benifit - $data['benifit'];
        }
        $data['created_at'] = time();
        return $data;
    }

}

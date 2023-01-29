<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Selling;
use Yii;
use yii\web\Response;
use common\models\Backlog;
use common\models\DebtAmount;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class SellingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Selling();

        $backlog = new Backlog();
        if ($backlog->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $model->type_pay = Selling::PAY_DEBT;
            $model->save();
            $backlog->selling_id = $model->id;
            if ($backlog->save()) {
                $backlog->saved();
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                throw new HttpException('500', 'Serverning ichki xatosi qaytadan urinib ko\'ring');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $product_id = Yii::$app->request->post('product_id');
            $type_sell = Yii::$app->request->post('type_sell');

            $res = $model->getProductSellPrice($product_id, $type_sell);

            return $res;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionProduct()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = Product::find()->andWhere(['category_id' => $id, 'status' => Product::STATUS_ACTIVE])->all();
            if ($id != null && count($list) > 0) {
                foreach ($list as $account) {
                    $out[] = ['id' => $account->id, 'name' => $account->product_name];
                }
                return ['output' => $out];
            }
        }
        return ['output' => ''];
    }

    public function actionPayDebt($id)
    {
        $model = DebtAmount::findOne(['debtor_id' => $id]);

        if (Yii::$app->request->isPost) {
            $pay_summ = Yii::$app->request->post('pay_summ');
            $model->pay_debt += $pay_summ;
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                throw new HttpException('500', 'Saqlab bo\'lmadi!');
            }
        }

        return false;
    }
}

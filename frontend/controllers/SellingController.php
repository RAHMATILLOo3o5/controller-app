<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Selling;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Response;

class SellingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Selling();

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
            $list = Product::find()->andWhere(['category_id' => $id])->all();
            if ($id != null && count($list) > 0) {
                foreach ($list as $account) {
                    $out[] = ['id' => $account->id, 'name' => $account->product_name];
                }
                return ['output' => $out];
            }
        }
        return ['output' => ''];
    }
}

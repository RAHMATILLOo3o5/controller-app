<?php

namespace restapi\controllers;

use common\models\Selling;
use yii\web\NotFoundHttpException;
use restapi\models\ProductModel;
use Yii;
use yii\data\ActiveDataProvider;

class ProductController extends BaseController
{

    public $modelClass = ProductModel::class;


    public function actions()
    {
        $action = parent::actions();

        unset($action['create']);
        unset($action['update']);
        unset($action['view']);
        $action['index']['prepareDataProvider'] = [$this, 'dataProvider'];
        return $action;
    }

    public function dataProvider()
    {
        $status = Yii::$app->request->get('status', 10);
        $data = new ActiveDataProvider([
            'query' => ProductModel::find()->where(['status' => $status]),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $data;
    }

    public function actionCreate()
    {
        $model = new ProductModel();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post(), '')) {
            $model->status = $model::STATUS_ACTIVE;
            $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);

            return ($model->save()) ? $model : null;
        } else {
            return $model->errors;
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findMOdel($id);

        if (Yii::$app->request->isPut || Yii::$app->request->isPatch) {
            if ($model->load(Yii::$app->request->bodyParams, '')) {
                $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);
                return $model->save();
            }
        } else {
            return $model->errors;
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;
        return $model->save();
    }

    public function actionView($id)
    {
        $product = $this->findMOdel($id);
        return [
            'product_stats' => [
                'all_amount' => $product->all_amount,
                'selling_amount' => $product->sellingProductAmount,
                'selling_cash_amount' => $product->cashProductAmount,
                'selling_debt_amount' => $product->debtProductAmount,
                'selling_online_amount' => $product->onlineProductAmount,
                'all_selling_money' => $product->allSumm,
                'remaining_summ' => $product->aboutSumm
            ],
            'product_info' => $product,
            'selling_list' => Selling::find()->where(['product_id' => $id])->orderBy(['id' => SORT_DESC])->all()
        ];
    }

    public function findMOdel($id)
    {
        if ($id != null) {
            return ProductModel::findOne(['id' => $id]);
        } else {
            throw new NotFoundHttpException('Bu sahifa mavjud emas!.');
        }
    }
}

<?php

namespace restapi\controllers;

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
        $action['index']['prepareDataProvider'] = [$this, 'dataProvider'];
        return $action;
    }

    public function dataProvider()
    {
        $status = Yii::$app->request->get('status', 10);
        $data = new ActiveDataProvider([
            'query' => ProductModel::find()->where(['status' => $status])
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
            if ($model->load(Yii::$app->request->post(), '')) {
                $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);
                return ($model->save()) ? $model : null;
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

    public function findMOdel($id)
    {
        if ($id != null) {
            return ProductModel::findOne(['id' => $id]);
        } else {
            throw new NotFoundHttpException('Bu sahifa mavjud emas!.');
        }
    }
}

<?php

namespace backend\controllers;

use backend\models\OneOfProduct;
use common\models\search\ProductQuery;
use Yii;
use yii\web\NotFoundHttpException;
use backend\models\ProductBackendModel;
use common\models\Product;
use common\models\Selling;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{
    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allMoney' => $searchModel->allMoney
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = Selling::find()->orderBy(['id' => SORT_DESC])->where(['product_id' => $id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'selling_list' => new ActiveDataProvider(['query' => $query])
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductBackendModel();
        $model2 = new OneOfProduct();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = $model::STATUS_ACTIVE;
                $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);
                return $model->save() && $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'model2'));
    }


    public function actionOneCreate()
    {
        $model = new OneOfProduct();
        if (Yii::$app->request->isPost && $model->load($this->request->post())) {

            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->converd_currency = $model->setConverdCurrency($model->product_purchase_price, $model->currency_price);
            return $model->save() && $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $product = $this->findModel($id);
        $product->status = $product::STATUS_DELETE;
        $product->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductBackendModel::findOne(['id' => $id, 'status'=> Product::STATUS_ACTIVE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace backend\controllers;

use common\models\Product;
use common\models\ProductCategory;
use common\models\search\ProductCategoryQuery;
use kartik\form\ActiveForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends BaseController
{

    /**
     * Lists all ProductCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategoryQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if (Yii::$app->request->get('id')) {
            $model = $this->findModel(Yii::$app->request->get('id'));
        } else {
            $model = new ProductCategory();
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single ProductCategory model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $products = new ActiveDataProvider(
            [
                'query' => Product::find()->where(['category_id' => $id])->orderBy(['id' => SORT_DESC])
            ]
        );
        return $this->render('view', [
            'model' => $this->findModel($id),
            'products' => $products
        ]);
    }

    /**
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProductCategory();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Saqlandi', true);
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash('danger', 'Saqlanmadi', true);
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Xatolik', true);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    /**
     * Updates an existing ProductCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Saqlandi', true);
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Saqlanmadi', true);
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Xatolik', true);
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing ProductCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

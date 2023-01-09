<?php

namespace backend\controllers;

use common\models\OtherSpent;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;

/**
 * OtherSpentController implements the CRUD actions for OtherSpent model.
 */
class OtherSpentController extends BaseController
{
    /**
     * Lists all OtherSpent models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => OtherSpent::find(),
            'pagination' => [
                'pageSize' => 30
            ],
            'sort' =>[
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        if (Yii::$app->request->get('id')) {
            $model = $this->findModel(Yii::$app->request->get('id'));
        } else {
            $model = new OtherSpent();
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single OtherSpent model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OtherSpent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OtherSpent();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OtherSpent model.
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
     * Deletes an existing OtherSpent model.
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
     * Finds the OtherSpent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OtherSpent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OtherSpent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

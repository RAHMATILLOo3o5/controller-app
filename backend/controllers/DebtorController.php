<?php

namespace backend\controllers;

use common\models\Backlog;
use common\models\DebtAmount;
use common\models\Debtor;
use common\models\search\DebtorQuery;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * DebtorController implements the CRUD actions for Debtor model.
 */
class DebtorController extends BaseController
{
    /**
     * Lists all Debtor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DebtorQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Debtor model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $backlog = new ActiveDataProvider([
            'query' => Backlog::find()->where(['debtor_id' => $id])
        ]);
        $debt = DebtAmount::findOne(['debtor_id' => $id]);
        $model = $this->findModel($id);

        if ($debt->remainingDebt == 0) {
            $model->status = Debtor::INACTIVE;
            $model->save();
        }

        return $this->render('view', [
            'model' => $model,
            'backlog' => $backlog,
            'debt' => $debt
        ]);
    }

    /**
     * Creates a new Debtor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Debtor();
        $debt = new DebtAmount();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = $model::ACTIVE;
                $model->save();
                $debt->debtor_id = $model->id;
                $debt->all_debt_amount = 0;
                $debt->pay_debt = 0;
                $debt->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Debtor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Debtor model.
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
     * Finds the Debtor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Debtor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Debtor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

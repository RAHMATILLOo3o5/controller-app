<?php

namespace restapi\controllers;

use common\models\Worker;
use restapi\models\SellingModel;
use restapi\models\WorkerModel;
use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class WorkerController extends BaseController
{
    public $modelClass = WorkerModel::class;

    public function actions()
    {
        $action = parent::actions();
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
        unset($action['view']);
        return $action;
    }

    public function actionCreate()
    {
        $model = new WorkerModel();

        if (Yii::$app->request->isPost) {
            if ($model->load($this->request->post(), '')) {
                $model->setPassword($model->full_name);
                $model->generateAuthKey();
                $model->save();
                return $model;
            } else {
                return $model->errors;
            }
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPut || $this->request->isPatch) {
            if ($model->load($this->request->post(), '')) {
                $model->setPassword($model->full_name);
                $model->save();
                return $model;
            } else {
                return $model->errors;
            }
        } else {
            throw new MethodNotAllowedHttpException("Method Not Allowed. This URL can only handle the following request methods: POST.");
        }
    }

    public function actionDelete($id)
    {
        $worker = $this->findModel($id);

        $worker->status = Worker::STATUS_DELETED;
        return $worker->save();
    }

    public function actionView($id)
    {
        $worker = $this->findModel($id);

        return [
            'worker_info' => $worker,
            'worker_stats' => [
                ''
            ],
            'selling_list' => SellingModel::find()->where(['worker_id' => $id])->orderBy(['id' => SORT_DESC])->all()
        ];
    }

    protected function findModel($id)
    {
        if (($model = WorkerModel::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace restapi\controllers;

use restapi\models\CategoryModel;
use Yii;
use yii\base\NotSupportedException;
use yii\data\ActiveDataProvider;
use yii\db\conditions\NotCondition;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;


class CategoryController extends BaseController
{
    public $modelClass = CategoryModel::class;

    public function actions()
    {
        $action = parent::actions();

        unset($action['delete']);
        unset($action['update']);
        $action['index']['prepareDataProvider'] = [$this, 'dataProvider'];
        return $action;
    }

    public function dataProvider()
    {
        return new ActiveDataProvider([
            'query' => CategoryModel::find()->where(['status' => 1]),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
    }


    public function actionUpdate($id)
    {
        $model  = $this->findModel($id);
        if ($this->request->isPut || $this->request->isPatch) {
            if($model->load(Yii::$app->request->post(), '')){
                return $this->request->post();
            }
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;
        return $model->save();
    }

    protected function findModel($id)
    {
        if (($model = CategoryModel::findOne(['id' => $id, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

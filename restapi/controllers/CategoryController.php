<?php

namespace restapi\controllers;

use restapi\models\CategoryModel;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;


class CategoryController extends BaseController
{
    public $modelClass = CategoryModel::class;

    public function actions()
    {
        $action = parent::actions();

        unset($action['delete']);
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

        throw new NotFoundHttpException('Bu sahifa mavjud emas!.');
    }
}

<?php

use common\models\ProductCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\ProductCategoryQuery $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kataloglar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="card p-md-2">
            <div class="card-header">
                <?php $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_VERTICAL
                ]); ?>

                <div class="row">

                    <div class="col-md-3">
                        <?= $form->field($model, 'category_name')->textInput(['maxlength' => true, 'placeholder' => 'Katalog nomi'])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'unit')->textInput(['placeholder' => 'Birligi kg/dona'])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group d-flex align-center">
                            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="card-body">
                <?php Pjax::begin(); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'attribute' => 'id',
                            'filter' => false
                        ],
                        'category_name',
                        [
                            'attribute' => 'unit',
                            'filter' => [
                                '0' => 'KG',
                                '1' => 'DONA'
                            ]
                        ],
                        [
                            'attribute' => 'created_at',
                            'filter' => false
                        ],
                        [
                            'class' => ActionColumn::class,
                            'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            },
                            'buttons' => [
                                'view' => function ($url) {
                                    return Html::a('<i class="fe fe-eye"></i>', $url, ['class' => 'btn btn-info btn-sm']);
                                },
                                'update' => function ($url) {
                                    return Html::a('<i class="fe fe-pen-tool"></i>', $url, ['class' => 'btn btn-primary btn-sm']);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<i class="fe fe-trash"></i>', $url, ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']);
                                }
                            ],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>

    </div>

</div>
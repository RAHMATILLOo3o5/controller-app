<?php

use common\models\ProductCategory;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use yii\bootstrap5\LinkPager;

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
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'options' => [
                        'id' => 'caty-form'
                    ],
                    'action' => (Yii::$app->request->get('id')) ? Url::toRoute(['product-category/update', 'id' => Yii::$app->request->get('id')]) : Url::toRoute(['product-category/create'])
                ]); ?>

                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'category_name')->textInput(['maxlength' => true, 'placeholder' => 'Katalog nomi'])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'unit')->widget(Select2::class, [
                            'data' => $model->unitVal,
                            'hideSearch' => true,
                            'options' => [
                                'placeholder' => 'Birligi kg/dona'
                            ]
                        ])->label(false) ?>
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

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table'
                    ],
                    'columns' => [
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
                            ],
                            'value' => 'unitLabel',
                            'format' => 'html'
                        ],
                        [
                            'attribute' => 'created_at',
                            'filter' => false,
                            'format' => 'date'
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
                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fe fe-pen-tool"></i>', Url::to(['product-category/index', 'id' => $model->id]), ['class' => 'btn btn-primary btn-sm']);
                                },
                                'delete' => function ($url) {
                                    return Html::a('<i class="fe fe-trash"></i>', $url, ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']);
                                }
                            ],
                        ],
                    ],
                    'pager' => [
                        'class' => LinkPager::class
                    ]
                ]); ?>

            </div>
        </div>

    </div>

</div>
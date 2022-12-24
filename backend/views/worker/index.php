<?php

use common\models\Worker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\WorkerQuery $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ishchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card p-2">
            <p>
                <?= Html::a('Yangi qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table'
                ],
                'summary' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'full_name',
                    'phone_number',
                    'location',
                    [
                        'attribute' => 'password_hash',
                        'filter' => false,
                        'value' => 'full_name'
                    ],
                    //'auth_key',
                    //'type',
                    [
                        'attribute' => 'status',
                        'filter' => [
                            '0' => 'Nofaol',
                            '1'=>'Faol'
                        ]
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'date',
                        'filter' => false
                    ],
                    //'updated_at',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Worker $model, $key, $index, $column) {
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
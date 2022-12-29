<?php

use common\models\Debtor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\DebtorQuery $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Qarzdorlar daftari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debtor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card p-2">
        <p>
            <?= Html::a('Qarzdor qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' => false,
                'tableOptions' => [
                    'class' => 'table'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'full_name',
                    'location',
                    'phone_number',
                    [
                        'attribute' => 'status',
                        'filter' => [
                            '0' => 'To\'lagan',
                            '10' => 'Qarzdor'
                        ],
                        'format' => 'html',
                        'value' => 'statusLabel'
                    ],
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Debtor $model, $key, $index, $column) {
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
                    ]
                ],
            ]); ?>
        </div>

        <?php Pjax::end(); ?>
    </div>

</div>
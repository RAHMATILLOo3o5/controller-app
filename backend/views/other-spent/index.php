<?php

use common\models\OtherSpent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Boshqa harajatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow">

    <div class="card-header">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>

    <div class="card-body">
        <div class="d-flex align-items-center">
            <h6>Umumiy hisobda sarflangan:</h6>
            <h5 class="text-danger ml-1"> <?= number_format($model->allSumm, 1, '.', ' ') ?> <span class="text-dark">sum</span></h5>
        </div>
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'tableOptions' => [
                'class' => 'table table-bordered'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'name',
                [
                    'attribute' => 'summ',
                    'value' => 'FormatSumm'
                ],
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function (OtherSpent $model) {
                        if ($model->status == OtherSpent::ACTIVE) {
                            return "<span class='badge badge-success'>To'langan</span>";
                        }
                        return "<span class='badge badge-danger'>To'lanmagan</span>";
                    }
                ],
                'created_at:date',
                //'updated_at',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, OtherSpent $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'template' => "{update} \n {delete}",
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<i class="fe fe-pen-tool"></i>', Url::to(['product-category/index', 'id' => $model->id]), ['class' => 'btn btn-primary btn-sm']);
                        },
                        'delete' => function ($url) {
                            return Html::a('<i class="fe fe-trash"></i>', $url, ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']);
                        }
                    ]
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>
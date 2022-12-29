<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Debtor $model */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Qarzdorlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="debtor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-2">
                <div class="card-header">
                    <h3>Qarzdor haqida</h3>
                </div>
                <?= DetailView::widget([
                    'options' => [
                        'class' => 'table table-bordered'
                    ],
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'full_name',
                        'location',
                        'phone_number',
                        [
                            'attribute' => 'status',
                            'format' => 'html',
                            'value' => $model->statusLabel
                        ],
                        'created_at:date',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-2">
                <div class="card-header">
                    <h3>
                        Olgan qarzlari
                    </h3>
                </div>
            </div>
        </div>
    </div>

</div>
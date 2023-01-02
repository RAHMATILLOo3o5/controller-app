<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

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
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-2">
                <div class="card-header ">
                    <h3>Qarzdor haqida</h3>
                </div>
                <div class="card-header">
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
                <div class="card-footer">
                    <h4>Qarzni to'lash</h4>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        Olgan qarzlari
                    </h3>
                    <div>
                        <b>Umumiy qarz summasi</b>
                        <span><?= number_format($backlog->models[0]->backlogAmount, 2, '.', ' ') ?></span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?= ListView::widget([
                            'summary' => false,
                            'dataProvider' => $backlog,
                            'itemView' => '_backlog-item'
                        ]) ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
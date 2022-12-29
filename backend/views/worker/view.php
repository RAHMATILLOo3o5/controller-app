<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Worker $model */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Ishchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">

    <div class="col-12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col-md-6">
        <div class="card p-md-2">
            <div class="card-header">
                <h3 class="card-title">Ishchi haqida ma'lumotlar </h3>
                <p>
                    <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Siz rostdan ham bu ishchini o\'chirmoqchimiz?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>

            <div class="card-body table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => [
                        'class' => 'table table-bordered'
                    ],
                    'attributes' => [
                        'full_name',
                        'phone_number',
                        'location',
                        [
                            'attribute' => 'password_hash',
                            'value' =>  $model->full_name
                        ],
                        [
                            'attribute' => 'type',
                            'format' => 'html',
                            'value' => $model->statusLabel
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'html',
                            'value' => $model->typeLabel
                        ],
                        'created_at:date',
                        'updated_at:date',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-md-2">
            <div class="card-header">
                <h3 class="card-title">Ishchining ko'rsatkichlari</h3>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
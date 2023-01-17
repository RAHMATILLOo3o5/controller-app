`<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;


/* This is setting the title of the page, the breadcrumbs and registering the YiiAsset. */

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
                                'attribute' => 'author_id',
                                'value' => function (\common\models\Debtor $model) {
                                    return Html::a("{$model->author->full_name}", Url::to(['worker/view', 'id' => $model->id]));
                                },
                                'format' => 'html'
                            ],
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
                    <?php $f = ActiveForm::begin([
                        'action' => Url::toRoute(['selling/pay-debt', 'id' => $debt->debtor_id])
                    ]); ?>
                    <div class="form-group">
                        <label for="">Qarz miqdori:</label>
                        <?= Html::input('text', 'debt-amount', $debt->remainingDebt, ['readonly' => true, 'class' => 'form-control', 'id' => 'debtamount-all_debt_amount']) ?>
                    </div>
                    <div class="form-group">
                        <label for="pay_summ">To'layabdi</label>
                        <?= Html::input('number', 'pay_summ', '', ['class' => 'form-control', 'required' => true, 'id' => 'pay_summ']) ?>
                    </div>
                    <div class="form-group">
                        <label for="remain_sum">Qolgan summasi</label>
                        <?= Html::input('number', 'remain_sum', '', ['class' => 'form-control', 'id' => 'remain_sum', 'readonly' => true]) ?>
                    </div>
                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success sbn']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <b>Umumiy qarz summasi</b> <br>
                        <span><?= number_format($model->debtAmount->all_debt_amount, 2, '.', ' ') ?></span>
                    </div>
                    <div>
                        <b>To'lagam summasi</b> <br>
                        <span class="text-success"><?= number_format($model->debtAmount->pay_debt, 2, '.', ' ') ?></span>
                    </div>
                    <div>
                        <b>Qolgan qarzi</b> <br>
                        <span class="text-danger"><?= number_format($model->debtAmount->remainingDebt, 2, '.', ' ') ?></span>
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
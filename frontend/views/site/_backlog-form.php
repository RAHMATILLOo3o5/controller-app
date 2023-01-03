<?php

use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card-body">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'sell-form'
        ],
        'action' => Url::toRoute(['selling/index'])
    ]); ?>
    <?= $form->field($backlog, 'debtor_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($backlog->debtorList, 'id', 'full_name'),
        'options' => [
            'placeholder' => 'Qarzorlar'
        ]
    ]) ?>
    <?= $form->field($model, 'category_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->categoryList, 'id', 'category_name'),
        'options' => [
            'placeholder' => 'Katalogni tanlang:',
            'id' => 'category'
        ],
    ]) ?>
    <?= $form->field($model, 'product_id')->widget(DepDrop::class, [
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'url' => Url::toRoute(['selling/product']),
            'depends' => ['category'],
            'loadingText' => "Mahsulotlar ro`yhat yuklanmoqda ...",
        ],
        'options' => [
            'placeholder' => 'Mahsulotni tanlang:',
            'id' => 'product'
        ],
    ]) ?>

    <?= $form->field($model, 'type_sell')->widget(Select2::class, [
        'data' => $model->sellList,
        'hideSearch' => true,
        'options' => [
            'id' => 'sell-type'
        ]
    ]) ?>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="sell-min">Minimal sotish narxi:</label>
                <input type="text" class="form-control" id="sell-min-back" readonly value="0">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="sell-max">Maksimal sotish narxi:</label>
                <input type="text" class="form-control" id="sell-max-back" readonly value="0">
            </div>
        </div>
    </div>
    <?= $form->field($model, 'sell_amount')->textInput(['id' => 'sell_amount', 'required' => 'required']) ?>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="sell-all-min">Minimal umumiy summa:</label>
                <input type="text" class="form-control" id="sell-all-min-back" readonly value="0">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="sell-all-max">Maksimal umumiy summa:</label>
                <input type="text" class="form-control" id="sell-all-max-back" readonly value="0">
            </div>
        </div>
    </div>
    <?= $form->field($model, 'sell_price')->textInput(['id' => 'sell', 'required' => 'required']) ?>
    <?= $form->field($backlog, 'backlog_amount')->textInput(['value' => 0])->label('Hozir to\'lamoqchi') ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'id' => 'submit_button2']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
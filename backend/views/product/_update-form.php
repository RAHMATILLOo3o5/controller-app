<?php

use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<div class="card p-1">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'category_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->categoryList, 'id', 'category_name'),
        'options' => [
            'placeholder' => 'Katalogni tanlang:'
        ]
    ]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['id' => 'amount']) ?>

    <?= $form->field($model, 'every_amount')->textInput(['id' => 'every-amount']) ?>

    <?= $form->field($model, 'all_amount')->textInput(['id' => 'all-amount', 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'product_purchase_price')->textInput() ?>

    <?= $form->field($model, 'type_of_currency')->widget(Select2::class, [
        'data' => $model->currencyLabel,
        'hideSearch' => true
    ]) ?>

    <?= $form->field($model, 'currency_price')->textInput() ?>

    <?= $form->field($model, 'min_sell_price_retail')->textInput() ?>

    <?= $form->field($model, 'max_sell_price_retail')->textInput() ?>

    <?= $form->field($model, 'min_sell_price_good')->textInput() ?>

    <?= $form->field($model, 'max_sell_price_good')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
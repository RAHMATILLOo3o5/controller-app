<?php

use component\GetCurrency;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */


?>

<div class="card p-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['id' => 'amount']) ?>

    <?= $form->field($model, 'every_amount')->textInput(['id' => 'every-amount']) ?>

    <?= $form->field($model, 'all_amount')->textInput(['id' => 'all-amount', 'readonly' => 'readonly']) ?>

    <?= $form->field($model, 'product_purchase_price')->textInput() ?>

    <?= $form->field($model, 'type_of_currency')->widget(Select2::class, [
        'data' => $model->currencyLabel,
        'hideSearch' => true
    ]) ?>
    
    <?= $form->field($model, 'min_sell_price_retail')->textInput() ?>

    <?= $form->field($model, 'max_sell_price_retail')->textInput() ?>

    <?= $form->field($model, 'min_sell_price_good')->textInput() ?>

    <?= $form->field($model, 'max_sell_price_good')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

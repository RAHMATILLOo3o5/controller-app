<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\ProductQuery $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_name') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'every_amount') ?>

    <?= $form->field($model, 'all_amount') ?>

    <?php // echo $form->field($model, 'product_purchase_price') ?>

    <?php // echo $form->field($model, 'type_of_currency') ?>

    <?php // echo $form->field($model, 'currency_price') ?>

    <?php // echo $form->field($model, 'min_sell_price_retail') ?>

    <?php // echo $form->field($model, 'max_sell_price_retail') ?>

    <?php // echo $form->field($model, 'min_sell_price_good') ?>

    <?php // echo $form->field($model, 'max_sell_price_good') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

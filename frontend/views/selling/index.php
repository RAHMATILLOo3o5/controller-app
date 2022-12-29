<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Selling $model */
/** @var ActiveForm $form */
?>
<div class="selling-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'category_id') ?>
        <?= $form->field($model, 'product_id') ?>
        <?= $form->field($model, 'worker_id') ?>
        <?= $form->field($model, 'sell_price') ?>
        <?= $form->field($model, 'sell_amount') ?>
        <?= $form->field($model, 'type_sell') ?>
        <?= $form->field($model, 'type_pay') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'updated_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- selling-index -->

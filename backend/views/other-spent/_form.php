<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\OtherSpent $model */
/** @var kartik\widgets\ActiveForm $form */
?>

<div class="mt-3">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['other-spent/create'])
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Sarf nomi'])->label(false) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'summ')->textInput(['placeholder' => 'Summasi'])->label(false) ?>
        </div>
        <div class="col-md-4">
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
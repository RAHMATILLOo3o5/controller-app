<?php

use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var common\models\Worker $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card p-2">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->widget(MaskedInput::class, [
        'mask' => '+\9\98 99 999-99-99'
    ]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->widget(Select2::class, [
        'data' => $model->typeList
    ]) ?>

    <?= $form->field($model, 'status')->widget(Select2::class, [
        'data' => $model->statusList,
        'hideSearch' => true
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

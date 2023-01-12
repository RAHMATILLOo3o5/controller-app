<?php

use kartik\form\ActiveForm;
use yii\bootstrap5\Html;

$this->title = "Parolni o'zgartirish"

?>

<div class="card">
    <div class="card-header">
        <h2><?= Html::encode($this->title) ?></h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <?php $f = ActiveForm::begin([
                ]) ?>

                <?= $f->field($model, 'old_password')->passwordInput() ?>
                <?= $f->field($model, 'new_password')->passwordInput() ?>
                <?= $f->field($model, 'confirm_password')->passwordInput() ?>
                
                <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
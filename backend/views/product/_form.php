<?php

use component\GetCurrency;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>
<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Optom kiritish</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Donalab kiritish</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        Anim pariatur cliche reprehenderit, enim eiusmod high
        life accusamus terry richardson ad squid. 3 wolf moon
        officia aute, non cupidatat skateboard dolor brunch.
    </div>
</div>
<?php

use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Selling $model */
/** @var ActiveForm $form */
?>
<div class="card-body">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'sell-form'
        ],
        'action' => Url::toRoute(['selling/index'])
    ]); ?>

    <?= $form->field($model, 'category_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->categoryList, 'id', 'category_name'),
        'options' => [
            'placeholder' => 'Katalogni tanlang:'
        ],
    ]) ?>
    <?= $form->field($model, 'product_id')->widget(DepDrop::class, [
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'url' => Url::toRoute(['selling/product']),
            'depends' => ['selling-category_id'],
            'loadingText' => "Mahsulotlar ro`yhat yuklanmoqda ...",
        ],
        'options' => [
            'placeholder' => 'Mahsulotni tanlang:',
        ],
    ]) ?>

    <?= $form->field($model, 'type_sell')->widget(Select2::class, [
        'data' => $model->sellList,
        'hideSearch' => true
    ]) ?>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="sell-min">Minimal sotish narxi:</label>
                <input type="text" class="form-control" id="sell-min" readonly value="0">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="sell-max">Maksimal sotish narxi:</label>
                <input type="text" class="form-control" id="sell-max" readonly value="0">
            </div>
        </div>
    </div>
    <?= $form->field($model, 'sell_amount') ?>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="sell-all-min">Minimal umumiy summa:</label>
                <input type="text" class="form-control" id="sell-all-min" readonly value="0">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="sell-all-max">Maksimal umumiy summa:</label>
                <input type="text" class="form-control" id="sell-all-max" readonly value="0">
            </div>
        </div>
    </div>
    <?= $form->field($model, 'sell_price') ?>
    <?= $form->field($model, 'type_pay')->widget(Select2::class, [
        'data' => $model->payList,
        'hideSearch' => true
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-primary', 'id' => 'submit_button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- selling-index -->
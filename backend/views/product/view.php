<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('O\'zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Rostdan ham bu mahsulotni o\'chirmoqchimisiz?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mahsulot haqida</h3>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => [
                            'class' => 'table table-bordered'
                        ],
                        'attributes' => [
                            'id',
                            'product_name',
                            [
                                'attribute' => 'amount',
                                'value' => $model->amountFormat
                            ],
                            [
                                'attribute' => 'every_amount',
                                'value' => $model->everyAmountFormat
                            ],
                            [
                                'attribute' => 'all_amount',
                                'value' => $model->allAmountFormat,
                                'format' => 'html'
                            ],
                            [
                                'attribute' => 'product_purchase_price',
                                'value' => $model->productPurchasePrice
                            ],
                            [
                                'attribute' => 'type_of_currency',
                                'value' => $model->currencyFormat,
                                'format' => 'html'
                            ],
                            [
                                'attribute' =>  'currency_price',
                                'value' => $model->currencyValue . ' sum'
                            ],
                            [
                                'attribute' =>  'converd_currency',
                                'value' => $model->currencyConverd . ' sum'
                            ],
                            [
                                'attribute' =>  'min_sell_price_retail',
                                'value' => $model->minSellPriceRetail . ' sum'
                            ],
                            [
                                'attribute' =>  'max_sell_price_retail',
                                'value' => $model->MaxSellPriceRetail . ' sum'
                            ],
                            [
                                'attribute' =>  'min_sell_price_good',
                                'value' => $model->MaxSellPriceGood . ' sum'
                            ],
                            [
                                'attribute' =>  'max_sell_price_good',
                                'value' => $model->MaxSellPriceGood . ' sum'
                            ],
                            [
                                'attribute' => 'status',
                                'value' => $model->statusLabel,
                                'format' => 'html'
                            ],
                            'created_at:date',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mahsulotning sotilishi</h3>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

</div>
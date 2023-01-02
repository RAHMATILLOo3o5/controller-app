<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Mahsulotlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$f = $model->all_amount * $model->sellingProductAmount / 100;
$q = $model->all_amount - $model->sellingProductAmount;
$qf = $model->all_amount * $q / 100;
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
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="">
                                <strong class="card-title">Sotish turlarining holati</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="chart-box">
                                        <div id="product-selling"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row align-items-center my-3">
                                        <div class="col">
                                            <strong>Umumiy</strong>
                                            <div class="my-0 text-muted small">Umumiy mahsulot hajmi</div>
                                        </div>
                                        <div class="col-auto">
                                            <strong>
                                                <?= $model->allAmountFormat ?>
                                            </strong>
                                        </div>
                                        <div class="col-3">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center my-3">
                                        <div class="col">
                                            <strong>Sotildi</strong>
                                            <div class="my-0 text-muted small">Sotilgan mahsulot hajmi</div>
                                        </div>
                                        <div class="col-auto">
                                            <strong><?= $model->sellingProductAmount ?></strong>
                                        </div>
                                        <div class="col-3">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $f ?>%" aria-valuenow="<?= $f ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center my-3">
                                        <div class="col">
                                            <strong>Qoldi</strong>
                                            <div class="my-0 text-muted small">Do'konda qolgan mahsulot hajmi</div>
                                        </div>
                                        <div class="col-auto">
                                            <strong><?= $q ?></strong>
                                        </div>
                                        <div class="col-3">
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

$this->registerJs('var donutChartWidget,
donutChartWidgetOptions = {
  series: [44, 55, 100],
  chart: {
    type: "donut",
    height: 180,
    zoom: { enabled: !1 },
    toolbar: { show: !1 },
  },
  theme: { mode: colors.chartTheme },
  plotOptions: {
    pie: {
      donut: { size: "40%", background: "transparent" },
      expandOnClick: !1,
    },
  },
  labels: ["Qarzga", "Naqd pulga", "Plastikka"],
  dataLabels: {
    enabled: !0,
    style: {
      fontSize: "10px",
      fontFamily: base.defaultFontFamily,
      fontWeight: "300",
    },
  },
  legend: { show: !1 },
  stroke: { show: !1, colors: colors.borderColor, width: 1, dashArray: 0 },
  fill: { opacity: 1, colors: ["#dc3545", "#1b68ff", "#3ad29f"] },
},
donutChartWidgetCtn = document.querySelector("#product-selling");
donutChartWidgetCtn &&
(donutChartWidget = new ApexCharts(
  donutChartWidgetCtn,
  donutChartWidgetOptions
)).render();');
?>
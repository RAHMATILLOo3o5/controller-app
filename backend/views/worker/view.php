<?php

use component\NumberFormatter;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Worker $model */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Ishchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
    <div class="row">

        <div class="col-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6">
            <div class="card p-md-2">
                <div class="card-header">
                    <h3 class="card-title">Ishchi haqida ma'lumotlar </h3>
                    <p>
                        <?= Html::a('Tahrirlash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Siz rostdan ham bu ishchini o\'chirmoqchimiz?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                </div>

                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => [
                            'class' => 'table table-bordered'
                        ],
                        'attributes' => [
                            'full_name',
                            'phone_number',
                            'location',
                            [
                                'attribute' => 'password_hash',
                                'value' => $model->full_name
                            ],
                            [
                                'attribute' => 'type',
                                'format' => 'html',
                                'value' => $model->typeLabel

                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'html',
                                'value' => $model->statusLabel

                            ],
                            'created_at:date',
                            'updated_at:date',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-md-2">
                <div class="card-header">
                    <h3 class="card-title">Ishchining ko'rsatkichlari</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div id="workerStat"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4 text-center">
                            <div class="mt-2">
                                <strong><?= NumberFormatter::letterFormat($model->allSum) ?> sum</strong><br/>
                                <span class="my-0 text-muted small">Keltirgan umumiy summasi</span>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="mt-2">
                                <strong>175</strong><br/>
                                <span class="my-0 text-muted small">Qarzga bergan summasi</span>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="mt-2">
                                <strong>126</strong><br/>
                                <span class="my-0 text-muted small">Naqd shakldagisi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerJs('var pieChartWidget,
pieChartWidgetOptions = {
  series: [686, 575, 426],
  chart: {
    type: "donut",
    height: 160,
    zoom: { enabled: !1 },
    toolbar: { show: !1 },
  },
  theme: { mode: colors.chartTheme },
  plotOptions: { pie: { donut: { size: "0" }, expandOnClick: !1 } },
  labels: ["Qarzga", "Naqd", "Plastik"],
  dataLabels: {
    enabled: !0,
    style: {
      fontSize: "10px",
      fontFamily: base.defaultFontFamily,
      fontWeight: "300",
    },
  },
  legend: { show: !1 },
  stroke: {
    show: !1,
    colors: extend.primaryColorLight,
    width: 1,
    dashArray: 0,
  },
  fill: { opacity: 1, colors: ["#dc3545", "#1b68ff", "#3ad29f"] },
},
pieChartWidgetCtn = document.querySelector("#workerStat");
pieChartWidgetCtn &&
(pieChartWidget = new ApexCharts(
  pieChartWidgetCtn,
  pieChartWidgetOptions
)).render();');
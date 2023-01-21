<?php

use common\models\Statistics;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Statistics $model */

$this->title = 'Do\'kon statistikasi';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="statistics-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row my-2">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-sm-between flex-wrap">
                            <a href="#" class="btn btn-outline-secondary m-1 m-md-0">Hammasi</a>
                            <a href="#" class="btn btn-outline-secondary m-1 m-md-0">Oxirgi 30 kunlik</a>
                            <a href="#" class="btn btn-outline-secondary m-1 m-md-0">Oxirgi 15 kunlik</a>
                            <a href="#" class="btn btn-outline-secondary m-1 m-md-0">Oxirgi 10 kunlik</a>
                            <a href="#" class="btn btn-outline-secondary m-1 m-md-0">Oxirgi 7 kunlik</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,

                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'id',
                                'period',
                                'total_benifit',
                                'total_spent',
                                'benifit',
                                'differrents',
                                'created_at:date',
                            ],
                            'pager' => [
                                'class' => LinkPager::class
                            ]
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title mb-0">Line Chart</strong>
                    </div>
                    <div class="card-body">
                        <div id="stat"></div>
                    </div> <!-- /.card-body -->
                </div>
            </div> <!-- /. col -->
        </div>
    </div>

<?php

$js = '
    var lineChart,
  lineChartoptions = {
    series: [
      {
        name: "Sof foyda",
        data: '. $model->proBenefit .',
      },
      {
        name: "Umumiy foyda",
        data: '. $model->totalProfit .',
      },
      {
        name: "Xarajatlar",
        data: '. $model->totalExpens .',
      },
    ],
    chart: {
      height: 350,
      type: "line",
      background: !1,
      zoom: { enabled: !1 },
      toolbar: { show: !1 },
    },
    theme: { mode: colors.chartTheme },
    stroke: {
      show: !0,
      curve: "smooth",
      lineCap: "round",
      colors: chartColors,
      width: [3, 2, 3],
      dashArray: [0, 0, 0],
    },
    dataLabels: { enabled: !1 },
    responsive: [
      {
        breakpoint: 480,
        options: { legend: { position: "bottom", offsetX: -10, offsetY: 0 } },
      },
    ],
    markers: {
      size: 4,
      colors: base.primaryColor,
      strokeColors: colors.borderColor,
      strokeWidth: 2,
      strokeOpacity: 0.9,
      strokeDashArray: 0,
      fillOpacity: 1,
      discrete: [],
      shape: "circle",
      radius: 2,
      offsetX: 0,
      offsetY: 0,
      onClick: void 0,
      onDblClick: void 0,
      showNullDataPoints: !0,
      hover: { size: void 0, sizeOffset: 3 },
    },
    xaxis: {
      type: "datetime",
      categories: '. $model->periodData .',
      labels: {
        show: !0,
        trim: !1,
        minHeight: void 0,
        maxHeight: 120,
        style: {
          colors: colors.mutedColor,
          cssClass: "text-muted",
          fontFamily: base.defaultFontFamily,
        },
      },
      axisBorder: { show: !1 },
    },
    yaxis: {
      labels: {
        show: !0,
        trim: !1,
        offsetX: -10,
        minHeight: void 0,
        maxHeight: 120,
        style: {
          colors: colors.mutedColor,
          cssClass: "text-muted",
          fontFamily: base.defaultFontFamily,
        },
      },
    },
    legend: {
      position: "top",
      fontFamily: base.defaultFontFamily,
      fontWeight: 400,
      labels: { colors: colors.mutedColor, useSeriesColors: !1 },
      markers: {
        width: 10,
        height: 10,
        strokeWidth: 0,
        strokeColor: colors.borderColor,
        fillColors: chartColors,
        radius: 6,
        customHTML: void 0,
        onClick: void 0,
        offsetX: 0,
        offsetY: 0,
      },
      itemMargin: { horizontal: 10, vertical: 0 },
      onItemClick: { toggleDataSeries: !0 },
      onItemHover: { highlightDataSeries: !0 },
    },
    grid: {
      show: !0,
      borderColor: colors.borderColor,
      strokeDashArray: 0,
      position: "back",
      xaxis: { lines: { show: !1 } },
      yaxis: { lines: { show: !0 } },
      row: { colors: void 0, opacity: 0.5 },
      column: { colors: void 0, opacity: 0.5 },
      padding: { top: 0, right: 0, bottom: 0, left: 0 },
    },
  },
  lineChartCtn = document.querySelector("#stat");
lineChartCtn &&
  (lineChart = new ApexCharts(lineChartCtn, lineChartoptions)).render();
   console.log('. $model->periodData .')
';

$this->registerJs($js);
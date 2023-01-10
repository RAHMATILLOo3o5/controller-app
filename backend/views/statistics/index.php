<?php

use common\models\Statistics;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Do\'kon statistikasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row my-2">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-sm-between">
                        <a href="#" class="btn btn-outline-secondary">Hammasi</a>
                        <a href="#" class="btn btn-outline-secondary">Oxirgi 30 kunlik</a>
                        <a href="#" class="btn btn-outline-secondary">Oxirgi 15 kunlik</a>
                        <a href="#" class="btn btn-outline-secondary">Oxirgi 10 kunlik</a>
                        <a href="#" class="btn btn-outline-secondary">Oxirgi 7 kunlik</a>
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
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title mb-0">Bar Chart</strong>
                    <div class="dropdown float-right">
                        <button class="btn btn-sm btn-link text-muted dropdown-toggle p-0" type="button" id="rangeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 7 days </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="rangeDropdown">
                            <a class="dropdown-item small text-muted" href="#">30 days</a>
                            <a class="dropdown-item small active" href="#">90 days</a>
                            <a class="dropdown-item small text-muted" href="#">All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChartjs" width="400" height="300"></canvas>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /. col -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title mb-0">Line Chart</strong>
                    <span class="badge badge-light float-right mr-2">30 days</span>
                    <span class="badge badge-light float-right mr-2">7 days</span>
                    <span class="badge badge-secondary float-right mr-2">Today</span>
                </div>
                <div class="card-body">
                    <canvas id="lineChartjs" width="400" height="300"></canvas>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /. col -->
    </div>
</div>
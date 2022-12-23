<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<?php

/** @var yii\web\View $this */

use yii\helpers\VarDumper;

$this->title = 'Bosh menu';
$d = date('Y-m-d');
$c = Yii::$app->session->get('currency');
?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted mb-1">AQSH Dollari</small>
                        <h3 class="card-title mb-0"><?= $c['usd'] ?></h3>
                        <p class="small text-muted mb-0">So'm</p>
                    </div>
                    <div class="col-4 text-right">
                        <span class="inlinebar"><i class="fe fe-dollar-sign fe-24"></i></span>
                    </div>
                </div> <!-- /. row -->
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted mb-1">Rossiya rubli</small>
                        <h3 class="card-title mb-0"><?= $c['rubl'] ?></h3>
                        <p class="small text-muted mb-0">So'm</p>
                    </div>
                    <div class="col-4 text-right">
                        <span class="inlineline fe-24">₽</span>
                    </div>
                </div> <!-- /. row -->
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted mb-1">EURO</small>
                        <h3 class="card-title mb-0"><?=$c['eur']?></h3>
                        <p class="small text-muted mb-0">So'm</p>
                    </div>
                    <div class="col-4 text-right">
                        <span class="inlinepie fe-24">€</span>
                    </div>
                </div> <!-- /. row -->
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow bg-primary text-white border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary-light">
                                    <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class="small text-muted mb-0">Monthly Sales</p>
                                <span class="h3 mb-0 text-white">$1250</span>
                                <span class="small text-muted">+5.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                </span>
                            </div>
                            <div class="col pr-0">
                                <p class="small text-muted mb-0">Orders</p>
                                <span class="h3 mb-0">1,869</span>
                                <span class="small text-success">+16.5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fe fe-16 fe-filter text-white mb-0"></i>
                                </span>
                            </div>
                            <div class="col">
                                <p class="small text-muted mb-0">Conversion</p>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-auto">
                                        <span class="h3 mr-2 mb-0"> 86.6% </span>
                                    </div>
                                    <div class="col-md-12 col-lg">
                                        <div class="progress progress-sm mt-2" style="height:3px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                    <i class="fe fe-16 fe-activity text-white mb-0"></i>
                                </span>
                            </div>
                            <div class="col">
                                <p class="small text-muted mb-0">AVG Orders</p>
                                <span class="h3 mb-0">$80</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

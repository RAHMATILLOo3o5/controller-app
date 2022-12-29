<?php

/** @var yii\web\View $this */

$this->title = 'Bosh menu';
?>


<div class="row">

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Naqd</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Qarzga</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?= $this->render('_selling-form', compact('model')) ?>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <?= $this->render('_backlog-form', compact('model', 'backlog')) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="h2 mb-0"><?= $model->cashPrice ?></span>
                                <p class="small text-muted mb-0">Naqd pulga sotilgan mahsulotlar summasi</p>
                            </div>
                            <div class="col-auto">
                                <span class="fe fe-32 fe-shopping-bag text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="h2 mb-0"><?= $model->onlinePrice ?></span>
                                <p class="small text-muted mb-0">Plastik orqali sotilgan mahsulotlar summasi</p>
                            </div>
                            <div class="col-auto">
                                <span class="fe fe-32 fe-clipboard text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="h2 mb-0">186</span>
                                <p class="small text-muted mb-0">Qarzga berilgan mahsulotlar summasi</p>
                                <span class="badge badge-pill badge-warning">+1.5%</span>
                            </div>
                            <div class="col-auto">
                                <span class="fe fe-32 fe-users text-muted mb-0"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
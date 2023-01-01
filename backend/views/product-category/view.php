<?php

use yii\widgets\ListView;

$this->title = "Katalog - " . $model->category_name
?>

<div class="card p-2">
    <div class="card-header">
        <div class="h2">
            <?= $this->title ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item active">
                    <span class="h3 text-white">Katalog haqida</span>
                </li>
                <li class="list-group-item">
                    <b>Katalog nomi:</b>
                    <span><?= $model->category_name ?></span>
                </li>
                <li class="list-group-item">
                    <b>Katalog birligi:</b>
                    <span><?= $model->unitLabel ?></span>
                </li>
                <li class="list-group-item">
                    <b>Yaratilgan vaqti:</b>
                    <span><?= date('d-m-Y', $model->created_at) ?></span>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="list-group list-group-flush">
                <span class="list-group-item active">
                    <span class="h3 text-white">Katalog mahsulotlari</span>
                </span>
                <?= ListView::widget([
                    'dataProvider' => $products,
                    'summary' => false,
                    'itemView' => '_category-item'
                ]) ?>
                </ul>
            </div>
        </div>
    </div>
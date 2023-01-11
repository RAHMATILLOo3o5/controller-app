<?php

/**
 * *@var common/models/Selling $model
 */

use common\models\Selling;
use yii\helpers\Url;

?>

<li class="list-group-item list-group-item-action border-0 p-0">
    <div class="row my-3 my-md-0 px-3">
        <div class="col-md-3 border py-2">
            <h6>Sotuvchi:</h6>
            <a href="<?= Url::to(['worker/view', 'id' => $model->worker->id]) ?>"><?= $model->worker->full_name ?></a>
        </div>
        <div class="col-md-3 border py-2">
            <h6>Sotgan summasi:</h6>
            <span><?= number_format($model->sell_price, 2, '.', ' ') ?></span>
        </div>
        <div class="col-md-3 border py-2">
            <h6>Sotish miqdori:</h6>
            <span><?= number_format($model->sell_amount, 0, '.', ' ') ?> <?= $model->product->category->unitLabel ?></span>
        </div>
        <div class="col-md-3 border py-2">
            <h6>Sotish vaqti:</h6>
            <span><?= date('d/m/Y H:i', $model->created_at) ?></span>
        </div>

    </div>
</li>
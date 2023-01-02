<?php

?>

<li class="list-group-item ">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>Mahsulot nomi:</b>
            <span><?= $model->selling->product->product_name ?></span>
        </div>
        <div>
            <b>Hajmi:</b>
            <span><?= $model->selling->sell_amount ?></span>
        </div>
        <div>
            <b>Summasi:</b>
            <span><?= number_format($model->selling->sell_price, 2, '.', ' ') ?></span>
        </div>
    </div>
</li>
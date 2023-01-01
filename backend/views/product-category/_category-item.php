<?php

use yii\helpers\Url;
?>
<a href="<?= Url::to(['/product/view', 'id' => $model->id]) ?>" class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
    <?= $model->product_name ?>
    <span class="badge badge-primary"><?= $model->all_amount ?></span>
</a>
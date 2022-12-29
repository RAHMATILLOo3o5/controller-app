<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Debtor $model */

$this->title = 'Tahrirlash: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Qarzdorlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tahrirlash';
?>
<div class="debtor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
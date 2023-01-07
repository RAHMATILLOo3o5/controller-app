<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OtherSpent $model */

$this->title = 'Update Other Spent: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Other Spents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="other-spent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

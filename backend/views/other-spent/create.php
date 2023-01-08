<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\OtherSpent $model */

$this->title = 'Create Other Spent';
$this->params['breadcrumbs'][] = ['label' => 'Other Spents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="other-spent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

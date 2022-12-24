<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Worker $model */

$this->title = 'Ishchi: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Ishchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Tahrirlash';
?>
<div class="row">

    <div class="col-md-8 offset-md-2">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Worker $model */

$this->title = 'Yangi ishchi';
$this->params['breadcrumbs'][] = ['label' => 'Ishchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

<div class="col-md-8 offset-md-2">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

</div>

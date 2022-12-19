<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row justify-content-center">

    <div class="col-md-8 offset-md-2">
        <h1 class="text-md-center"><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <h4 class="mt-md-5">Savollar bo'yicha aloqa markazi: <a href="https://t.me/Rahmatillo_2oo5" target="_blank"><i class="fe fe-send"></i>Telegram</a></h4>
    </div>

</div>

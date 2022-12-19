<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper vh-100">
    <div class="row align-items-center h-100">
        <?php $form = ActiveForm::begin([
            'options' => [
                'class' => 'col-lg-3 col-md-4 col-10 mx-auto text-center'
            ]
        ]); ?>
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                 xml:space="preserve">
              <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	"/>
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	"/>
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	"/>
              </g>
            </svg>
        </a>
        <h1 class="h6 mb-3">Kirish</h1>

        <?= $form->field($model, 'username')->textInput(['id' => 'inputEmail', 'class' => 'form-control form-control-lg', 'placeholder' => 'Username'])->label('Foydalanuvchi nomi', ['class' => 'sr-only']); ?>

        <?= $form->field($model, 'password')->passwordInput(['id' => 'password', 'class' => 'form-control form-control-lg', 'placeholder' => 'Password'])->label('Parol', ['class' => 'sr-only']); ?>

        <?php echo  $form->field($model, 'rememberMe')->checkbox()?>

        <?php echo Html::submitButton('Kirish', ['class' => 'btn btn-lg btn-primary btn-block'])?>
        <p class="mt-5 mb-3 text-muted">© 2022 | Powered by <a href="#">Husanboyev Rahmatullo</a></p>
        <?php ActiveForm::end(); ?>
    </div>
</div>

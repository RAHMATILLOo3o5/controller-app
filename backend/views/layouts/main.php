<?php

/** @var \yii\web\View $this */

/** @var string $content */

use component\SideBarMenu;
use backend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
        .form-control {
            box-shadow: none !important;
        }
    </style>
</head>

<body class="vertical  light  ">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('navbar') ?>
        <?= SideBarMenu::widget([
            'menuItem' => [
                ['label' => 'Bosh menu', 'url' => Url::home(), 'icon' => 'home'],
                ['label' => 'Kataloglar', 'url' => Url::to(['product-category/index']), 'icon' => 'server'],
                ['label' => 'Mahsulotlar', 'url' => Url::to(['product/index']), 'icon' => 'shopping-cart'],
                ['label' => 'Ishchilar', 'url' => Url::to(['worker/index']), 'icon' => 'users'],
                ['label' => 'Boshqa harajatlar', 'url' => Url::to(['other-spent/index']), 'icon' => 'list']
            ]
        ]); ?>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
            <?= $this->render('footer') ?>
        </main>
    </div>
    <?php $this->endBody() ?>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>

</body>

</html>
<?php $this->endPage();

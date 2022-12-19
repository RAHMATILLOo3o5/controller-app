<?php

use yii\helpers\Url;

/**
 * *@var $brandImage
 * *@var $items
 */
$route = Yii::$app->request->url;

?>

<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>

    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>


    <nav class="vertnav navbar navbar-light">

        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= Url::home() ?>">
                <?= $brandImage; ?>
            </a>
        </div>
        <?php foreach ($items as $item) :  ?>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100 <?= ($route === $item['url']) ? 'active' : '' ;  ?>">
                <a class="nav-link" href="<?= $item['url'] ?>">
                    <i class="fe fe-<?= (isset($item['icon'])) ? $item['icon'] : ''; ?> fe-16"></i>
                    <span class="ml-3 item-text"><?= $item['label'] ?></span>
                </a>
            </li>
        </ul>
        <?php endforeach; ?>
    </nav>


</aside>
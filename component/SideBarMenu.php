<?php

namespace component;

use yii\bootstrap5\Widget;
use yii\helpers\Url;

class SideBarMenu extends Widget
{

    public string $brandImage = '<svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve"><g><polygon class="st0" points="78,105 15,105 24,87 87,87 	"/><polygon class="st0" points="96,69 33,69 42,51 105,51 	"/><polygon class="st0" points="78,33 15,33 24,15 87,15 	"/></g></svg>';

    public array $menuItem = [];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('_render-sidebar', [
            'brandImage' => $this->brandImage,
            'items' => $this->menuItem
        ]);
    }

}
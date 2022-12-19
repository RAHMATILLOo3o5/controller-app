<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/simplebar.css',
        'https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap',
        'css/feather.css',
        'css/daterangepicker.css',
        'css/app-light.css'
    ];
    public $js = [
        "js/popper.min.js",
        "js/moment.min.js",
        "js/bootstrap.min.js",
        "js/simplebar.min.js",
        'js/daterangepicker.js',
        'js/jquery.stickOnScroll.js',
        "js/tinycolor-min.js",
        "js/config.js",
        "js/apps.js",
        "https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
}
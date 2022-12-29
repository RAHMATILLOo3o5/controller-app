<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/simplebar.css',
        'https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap',
        'css/feather.css',
        'css/select2.css',
        'css/dropzone.css',
        'css/uppy.min.css',
        'css/jquery.steps.css',
        'css/jquery.timepicker.css',
        'css/quill.snow.css',
        'css/daterangepicker.css',
        'css/app-light.css',
    ];
    public $js = [
        'js/popper.min.js',
        'js/moment.min.js',
        'js/bootstrap.min.js',
        'js/simplebar.min.js',
        'js/daterangepicker.js',
        'js/jquery.stickOnScroll.js',
        'js/tinycolor-min.js',
        'js/config.js',
        'js/d3.min.js',
        'js/topojson.min.js',
        'js/datamaps.all.min.js',
        'js/datamaps-zoomto.js',
        'js/datamaps.custom.js',
        'js/Chart.min.js',
        "js/gauge.min.js",
        "js/jquery.sparkline.min.js",
        "js/apexcharts.min.js",
        "js/apexcharts.custom.js",
        'js/dropzone.min.js',
        'js/uppy.min.js',
        'js/quill.min.js',
        'js/apps.js',
        'js/script.js',
        'https://www.googletagmanager.com/gtag/js?id=UA-56159088-1',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
}

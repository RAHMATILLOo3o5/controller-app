<?php

namespace restapi\modules\seller\controllers;

use restapi\controllers\BaseController;
use restapi\models\ProductModel;
use yii\rest\Serializer;

class SellerProductController extends BaseController
{
    public $modelClass = ProductModel::class;
    
    public $serializer = [
        'class' => Serializer::class,
    ];
}
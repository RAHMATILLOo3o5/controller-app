<?php

namespace restapi\modules\seller\controllers;

use restapi\controllers\BaseController;
use restapi\controllers\ProductController;
use restapi\models\ProductModel;
use yii\rest\Serializer;

class SellerProductController extends ProductController
{
    public $modelClass = ProductModel::class;
    
    public $serializer = [
        'class' => Serializer::class,
    ];

    public function actions()
    {
        $action = parent::actions();
        unset($action['create']);
        unset($action['update']);
        return $action;
    }

}
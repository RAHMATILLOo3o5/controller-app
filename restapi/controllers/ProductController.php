<?php

namespace restapi\controllers;

use restapi\models\ProductModel;
use yii\rest\ActiveController;

class ProductController extends ActiveController{

    public $modelClass = ProductModel::class;

}
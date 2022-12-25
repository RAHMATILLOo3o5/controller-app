<?php

namespace restapi\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class BaseController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }
}

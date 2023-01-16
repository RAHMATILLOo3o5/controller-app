<?php

namespace restapi\controllers;

use common\models\User;
use yii\filters\auth\HttpBearerAuth;
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
            'class' => Cors::class,
            
        ];
        
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
         
        return $behaviors;
    }
}

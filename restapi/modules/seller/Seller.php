<?php

namespace restapi\modules\seller;

use common\models\Worker;
use Yii;
use yii\web\User;

/**
 * seller module definition class
 */
class Seller extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'restapi\modules\seller\controllers';
    public $defaultRoute = 'site';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->set('user', [
            'class' => User::class,
            'enableAutoLogin' => true,
            'identityClass' => Worker::class,
            'loginUrl' => null,
            'identityCookie' => ['name' => 'seller', 'httpOnly' => true],
            'idParam' => 'seller'
        ]);
        // custom initialization code goes here
    }
}

<?php

namespace restapi\modules\seller\controllers;

use common\models\SellerToken;
use common\models\Worker;
use restapi\modules\seller\models\WorkerForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['http://example.com', 'https://example.com'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
    }

    public $defaultAction = 'login';

    public function actionLogin()
    {
        $model = new WorkerForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = Worker::findByUsername($model->username);
            $token = new SellerToken();
            $token->user_id = $user->id;
            $token->token = Yii::$app->security->generateRandomString(46);
            $token->expired_at = date('Y-m-d H:i:s', time() + 3600);
            $token->save();
            return $token->token;
        } else {
            return $model->errors;
        }
    }
}

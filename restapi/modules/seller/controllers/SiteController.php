<?php

namespace restapi\modules\seller\controllers;

use common\models\SellerToken;
use common\models\Worker;
use restapi\modules\seller\models\WorkerForm;
use Yii;
use yii\rest\Controller;

class SiteController extends Controller
{


    public $defaultAction = 'login';

    public function actionLogin()
    {
        $model = new WorkerForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = Worker::findByUsername($model->phone_number);
            $token = new SellerToken();
            $token->user_id = $user->id;
            $token->token = Yii::$app->security->generateRandomString(46);
            $token->expired_at = date('Y-m-d H:i:s', time() + 3600);
            $token->save();
            return [
                'token' => $token->token,
                'seller' => [
                    'id' => $user->id,
                    'type' => $user->type
                ]
            ];
        } else {
            return $model->errors;
        }
    }
}

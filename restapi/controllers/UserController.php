<?php

namespace restapi\controllers;

use restapi\models\LoginForm;
use Yii;
use common\models\Token;
use common\models\User;
use yii\rest\Controller;

class UserController extends Controller
{

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = User::findByUsername($model->username);
            $token = new Token();
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

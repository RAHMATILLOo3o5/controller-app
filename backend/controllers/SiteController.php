<?php

namespace backend\controllers;

use backend\models\ChangePassword;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\web\Response;
use component\GetCurrency;

/**
 * Site controller
 */
class SiteController extends BaseController
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!isset($_SESSION['currency']) || $_SESSION['currency']['time'] < time() ) {
            GetCurrency::getCurrentCurrencyValue();
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSetting()
    {
        $model = new ChangePassword();

        if($this->request->isPost && $model->load($this->request->post())){
            if($model->save()){
                return $this->goHome();
            } else{
                Yii::$app->session->setFlash('danger', 'Saqlanmai');
            }
        }

        return $this->render('setting', compact('model'));
    }
}

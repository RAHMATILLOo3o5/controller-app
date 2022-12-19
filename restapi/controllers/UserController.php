<?php

namespace restapi\controllers;

use restapi\models\UserModel;

class UserController extends \yii\rest\ActiveController
{
    public $modelClass = UserModel::class;
}
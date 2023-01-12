<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class ChangePassword extends Model
{

    public $old_password;
    public $new_password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'confirm_password'], 'required'],
            [['old_password', 'new_password', 'confirm_password'], 'string', 'length' => [8, 16]],
            [['confirm_password'], 'compare', 'compareAttribute' => 'new_password', 'message' => "{attribute} maydoni teng bo'lishi kerak {compareAttribute} maydoniga"]
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_password' => 'Amaldagi parol',
            'new_password' => 'Yanngi parol',
            'confirm_password' => 'Parolni tasdiqlash',
        ];
    }

    public function save()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);

        if ($user != null) {
            if ($user->validatePassword($this->old_password)) {
                $user->setPassword($this->new_password);
                return $user->save();
            } else {
                $this->addError($this->old_password, 'Foydalanuvchi nomi parol noto\'g\'ri.');
            }
        }
    }
}

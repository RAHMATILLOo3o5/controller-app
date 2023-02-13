<?php

namespace restapi\modules\seller\models;

use common\models\Worker;
use yii\base\Model;

class WorkerForm extends Model
{
    public $phone_number;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // phone_number and password are both required
            [['phone_number', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Foydalanuvchi nomi parol noto\'g\'ri.');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'phone_number' => 'Telefon raqam',
            'password' => 'Parol',
            'remeberMe' => 'Meni eslab qol'
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return true;
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Worker|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Worker::findByUsername($this->phone_number);
        }

        return $this->_user;
    }
}

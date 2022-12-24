<?php

namespace common\models;


use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "worker".
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone_number
 * @property string $location
 * @property string $password_hash
 * @property string|null $auth_key
 * @property int|null $type
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Worker extends \yii\db\ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const ADMIN = 10;
    const WORKER = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'worker';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['full_name', 'phone_number', 'location'], 'required'],
            [['full_name', 'phone_number', 'location', 'password_hash', 'auth_key'], 'string', 'min' => 3],
            [['type', 'updated_at', 'created_at'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'F.I.SH',
            'phone_number' => 'Telefon raqam',
            'location' => 'Yashash manzili',
            'password_hash' => 'Kirish paroli',
            'auth_key' => 'Auth Key',
            'type' => 'Vazifasi',
            'status' => 'Holati',
            'created_at' => 'Qo\'shilgan vaqti',
            'updated_at' => 'Oxirgi o\'zgarish',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($phone)
    {
        return static::findOne(['phone_number' => $phone, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getTypeList()
    {
        $r = [
            self::ADMIN => 'Admin',
            self::WORKER => 'Ishchi'
        ];

        return $r;
    }

    public function getStatusList(): array
    {
        $r = [
            static::STATUS_INACTIVE => 'Nofaol',
            static::STATUS_ACTIVE => 'Faol',
            static::STATUS_DELETED => 'O\'chirilgan',
        ];
        return $r;
    }

    public function getStatusLabel(): string
    {
        if ($this->status == self::STATUS_ACTIVE) {
            return "<span class='badge badge-success'>Faol</span>";
        } elseif ($this->status === self::STATUS_INACTIVE) {
            return "<span class='badge badge-warning'>Nofaol</span>";
        } else {
            return "<span class='badge badge-danger'>O'chirilgan</span>";
        }
    }

    public function getTypeLabel(): string
    {
        if($this->type == self::ADMIN){
            return "<span class='badge badge-info'>Adminlik huquqi mavjud</span>";
        }
        return "<span class='badge badge-primary'>Ishchi</span>";
    }
}

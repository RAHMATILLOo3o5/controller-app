<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seller_token".
 *
 * @property int $id
 * @property int $worker_id
 * @property string $token
 * @property string $expired_at
 */
class SellerToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seller_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'token', 'expired_at'], 'required'],
            [['worker_id'], 'default', 'value' => null],
            [['worker_id'], 'integer'],
            [['expired_at'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::class, 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'worker_id' => 'User ID',
            'token' => 'Token',
            'expired_at' => 'Expired At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Worker::class, ['id' => 'worker_id']);
    }

}

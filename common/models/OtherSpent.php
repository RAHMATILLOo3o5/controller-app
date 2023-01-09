<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "other_spent".
 *
 * @property int $id
 * @property string $name
 * @property float $summ
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class OtherSpent extends \yii\db\ActiveRecord
{

    const ACTIVE = 10;
    const INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'other_spent';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'summ'], 'required'],
            [['summ'], 'number'],
            [['status'], 'default', 'value' => 10],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Sarf nomi',
            'summ' => 'Summasi',
            'status' => 'Holati',
            'created_at' => 'To\'langan vaqti',
            'updated_at' => 'O\'zgartirish vaqti',
        ];
    }

    public function getFormatSumm(): string
    {
        return number_format($this->summ, 2, '.', ' '). " sum";
    }

    public function getAllSumm()
    {
        return self::find()->sum('summ');
    }
}

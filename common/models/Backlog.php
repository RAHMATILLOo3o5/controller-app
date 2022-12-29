<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "backlog".
 *
 * @property int $id
 * @property int|null $worker_id
 * @property int|null $selling_id
 * @property int|null $debtor_id
 * @property int|null $created_at
 *
 * @property Debtor $debtor
 * @property Selling $selling
 * @property Worker $worker
 */
class Backlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backlog';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'worker_id',
                'updatedByAttribute' => false
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'selling_id', 'debtor_id', 'created_at'], 'integer'],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::class, 'targetAttribute' => ['debtor_id' => 'id']],
            [['selling_id'], 'exist', 'skipOnError' => true, 'targetClass' => Selling::class, 'targetAttribute' => ['selling_id' => 'id']],
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
            'worker_id' => 'Worker ID',
            'selling_id' => 'Selling ID',
            'debtor_id' => 'Debtor ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Debtor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDebtor()
    {
        return $this->hasOne(Debtor::class, ['id' => 'debtor_id']);
    }

    /**
     * Gets query for [[Selling]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSelling()
    {
        return $this->hasOne(Selling::class, ['id' => 'selling_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Worker::class, ['id' => 'worker_id']);
    }
    
}

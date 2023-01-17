<?php

namespace common\models;

use restapi\models\WorkerModel;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "debtor".
 *
 * @property int $id
 * @property string $full_name
 * @property string $location
 * @property string $phone_number
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $author_id
 *
 * @property Worker $author
 */
class Debtor extends \yii\db\ActiveRecord
{

    const ACTIVE = 10;
    const INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debtor';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'author_id',
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
            [['full_name', 'location', 'phone_number'], 'required'],
            [['status', 'created_at', 'updated_at', 'author_id'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at', 'author_id'], 'integer'],
            [['full_name', 'location', 'phone_number'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::class, 'targetAttribute' => ['author_id' => 'id']],
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
            'location' => 'Yashash joyi',
            'phone_number' => 'Telefon raqami',
            'status' => 'Holati',
            'created_at' => 'Qo\'shilgan vaqti',
            'updated_at' => 'Updated At',
            'author_id' => 'Qo\'shgan ishchi',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\WorkerQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(WorkerModel::class, ['id' => 'author_id']);
    }

    public function getStatusLabel()
    {
        if ($this->status == self::ACTIVE) {
            return "<span class='badge badge-danger'>Qarzdor</span>";
        } else {
            return "<span class='badge badge-success'>To'langan</span>";
        }
    }

   /**
    * Get the debt amount for this debtor.
    * 
    * @return \yii\db\ActiveQuery DebtAmount model.
    */
    public function getDebtAmount()
    {
        return $this->hasOne(DebtAmount::class, ['debtor_id' => 'id']);
    }
}

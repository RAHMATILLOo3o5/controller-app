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
 * @property int|null $backlog_amount
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
            [['backlog_amount'], 'number'],
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
            'worker_id' => 'Ishchi',
            'selling_id' => 'Sotilgan mahsulot',
            'debtor_id' => 'Qarzdor ismi',
            'created_at' => 'Olingan vaqti',
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

    public function getDebtorList()
    {
        return Debtor::find()->orderBy(['full_name' => SORT_ASC])->all();
    }

    /**
     * > This function returns the sum of all the sell prices of the products that the current user has
     * sold
     */
    public function getSellPrice()
    {
        $r = self::findAll(['worker_id' => Yii::$app->user->id]);

        $arr = [];

        foreach ($r as $k) {
            $arr[] = Selling::findOne(['id' => $k->selling_id])->sell_price;
        }

        return array_sum($arr);
    }

    /**
     * Qarzdorning umumiy qarzi
     */
    public function getBacklogAmount()
    {
        $r = self::findAll(['debtor_id' => $this->debtor_id]);
        $arr = [];
        foreach ($r as $k) {
            $arr[] = Selling::findOne(['id' => $k->selling_id])->sell_price;
        }

        return array_sum($arr);
    }

    /**
     * Qolgan qarzlari
     */
    public function getDebtAmount()
    {
        $r = self::find()->where(['debtor_id' => $this->debtor_id])->sum('backlog_amount');
        $a = $this->getBacklogAmount();

        return $a - $r;
    }
    /**
     * To'lagan summasi
     */
    public function getPayAmount()
    {
        return $this->getBacklogAmount() - $this->getDebtAmount();
    }
    
    /**
     * saved
     *
     * @return bool
     */
    public function saved(): bool
    {
        $debtor = DebtAmount::findOne(['debtor_id' => $this->debtor_id]);
        if (!empty($debtor)) {
            $debtor->all_debt_amount = $this->getBacklogAmount();
            $debtor->pay_debt = $this->getPayAmount();
            return $debtor->save();
        } else {
            $debt = new DebtAmount();
            $debt->debtor_id = $this->debtor_id;
            $debt->all_debt_amount = $this->getBacklogAmount();
            $debt->pay_debt = $this->backlog_amount;
            return $debt->save();
        }
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "debt_amount".
 *
 * @property int $id
 * @property int|null $debtor_id
 * @property float|null $all_debt_amount
 * @property float|null $pay_debt
 *
 * @property Debtor $debtor
 */
class DebtAmount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debt_amount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['debtor_id'], 'default', 'value' => null],
            [['debtor_id'], 'integer'],
            [['all_debt_amount'], 'number'],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::class, 'targetAttribute' => ['debtor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'debtor_id' => 'Debtor ID',
            'all_debt_amount' => 'All Debt Amount',
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
     * It saves the debtor_id and all_debt_amount to the database
     * 
     * @param debtor_id The id of the debtor
     * @param all_debt_amount The total amount of debt that the debtor has.
     * 
     * @return bool The return value of the save() method.
     */
    public function saved($debtor_id, $all_debt_amount, $pay_debt): bool
    {
        $debtor = self::findOne(['debtor_id' => $debtor_id]);

        if (!empty($debtor)) {
            $debtor->pay_debt += $pay_debt;
            return $this->save();
        } else {
            $this->debtor_id = $debtor_id;
            $this->all_debt_amount = $all_debt_amount;

            return $this->save();
        }
    }

    public function getRemainingDebt()
    {

        return $this->all_debt_amount - $this->pay_debt;

    }
}

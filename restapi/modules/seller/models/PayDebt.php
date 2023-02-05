<?php

namespace restapi\modules\seller\models;

use yii\base\Model;
use common\models\DebtAmount;
use common\models\Debtor;

class PayDebt extends Model
{

    public $all_debt_amount;
    public $pay_debt;

    public function rules()
    {
        return [
            [['pay_debt'], 'required'],
            [['all_debt_amount', 'pay_debt'], 'number']
        ];
    }

    public function saved($debtor_id)
    {
        $debtor = DebtorModel::findOne($debtor_id);
        $debt = DebtAmount::findOne(['debtor_id' => $debtor_id]);
        $debt->pay_debt += $this->pay_debt;
        if ($debt->remainingDebt  == 0) {
            $debtor->status = Debtor::INACTIVE;
            return $debt->save() && $debtor->save();
        } else {
            return $debt->save();
        }
    }
}

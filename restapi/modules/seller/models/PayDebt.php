<?php

namespace restapi\modules\seller\models;

use yii\base\Model;

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
}

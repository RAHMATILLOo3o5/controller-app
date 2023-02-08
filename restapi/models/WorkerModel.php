<?php

namespace restapi\models;

use common\models\Worker;
use common\models\Selling;

class WorkerModel extends Worker
{
    public function fields()
    {
        return [
            'id',
            'full_name',
            'phone_number',
            'location',
            'type',
            'status',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Qarzga sotilgan mahsulot hajmi
     */
    public function getDebtProductAmount()
    {
        $r = Selling::find()->where(['worker_id' =>  $this->id, 'type_pay' => Selling::PAY_DEBT])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Naqd pulga sotilgan mahsulot hajmi
     */
    public function getCashProductAmount()
    {
        $r = Selling::find()->where(['worker_id' =>  $this->id, 'type_pay' => Selling::PAY_CASH])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Plastikka sotilgan mahsulot hajmi
     */
    public function getOnlineProductAmount()
    {
        $r = Selling::find()->where(['worker_id' =>  $this->id, 'type_pay' => Selling::PAY_ONLINE])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }
}

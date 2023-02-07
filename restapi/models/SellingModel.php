<?php

namespace restapi\models;

use common\models\Selling;

class SellingModel extends Selling
{
    public function fields()
    {
        return [
            'id',
            'sell_price',
            'sell_amount', 
            'type_sell', 
            'type_pay', 
            'created_at',
            'worker_id' => function () {
                return $this->worker;
            },
        ];
    }

    public function getWorker()
    {
        $worker = WorkerModel::findOne($this->worker_id);

        return [
            'id' => $worker->id,
            'full_name' => $worker->full_name,
            'phone_number' => $worker->phone_number,
            'location' => $worker->location
        ];
    }
}

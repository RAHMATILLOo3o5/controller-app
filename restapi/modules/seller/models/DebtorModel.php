<?php

namespace restapi\modules\seller\models;

use common\models\Debtor;
use restapi\models\WorkerModel;

class DebtorModel extends Debtor
{
    public function fields(): array
    {
        return [
            'id',
            'full_name',
            'location',
            'phone_number',
            'status',
            'created_at',
            'updated_at',
            'author_id' => function () {
                return $this->worker;
            },
        ];
    }

    public function getWorker()
    {
        $worker = WorkerModel::findOne($this->author_id);

        return [
            'id' => $worker->id,
            'full_name' => $worker->full_name
        ];
    }

    public function saved(array $debtorData)
    {
        $this->full_name = $debtorData['full_name'];
        $this->location = $debtorData['location'];
        $this->phone_number = $debtorData['phone_number'];
        $this->status = self::ACTIVE;

        return $this->save() ? $this->id : $this->errors;
    }
}

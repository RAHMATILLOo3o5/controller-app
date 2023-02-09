<?php

namespace restapi\models;

use common\models\Backlog;

class BacklogModel extends Backlog
{

    public function fields()
    {
        return [
            'selling_id' => function () {
                return SellingModel::findOne($this->selling_id);
            },
            'backlog_amount',
            'created_at'
        ];
    }
}

<?php

namespace restapi\modules\seller\models;

use common\models\Debtor;

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
            'author_id',
        ];
    }

}
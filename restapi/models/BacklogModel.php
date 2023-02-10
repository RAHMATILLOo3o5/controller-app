<?php

namespace restapi\models;

use common\models\Backlog;

class BacklogModel extends Backlog
{

    public function fields()
    {
        return [
            'selling_id' => function () {
                return $this->sellingProduct;
            },
            'backlog_amount',
            'created_at'
        ];
    }

    public function getSellingProduct()
    {
        $selling = $this->selling;

        return [
            'product_name' => $selling->product->product_name,
            'amount' => $selling->sell_amount,
            'price' => $selling->sell_price
        ];
    }
}

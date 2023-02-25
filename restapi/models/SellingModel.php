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
            'product_id',
            'sell_amount',
            'type_sell',
            'type_pay',
            'created_at',
            'worker_id' => function () {
                return $this->worker;
            },
            'category_id' => function () {
                return CategoryModel::findOne($this->category_id);
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
    public function saved(array $products, $type_pay)
    {
        $r = [];
        foreach ($products as $product) {
            $model = new $this;
            $model->category_id = $product['category_id'];
            $model->product_id = $product['product_id'];
            $model->type_sell = $product['type_sell'];
            $model->sell_amount = $product['sell_amount'];
            $model->sell_price = $product['sell_price'];
            $model->type_pay = $type_pay;
            if ($model->save()) {
                $r = true;
            } else {
                $r[] = $model->errors;
            }
        }
        return $r;
    }
}

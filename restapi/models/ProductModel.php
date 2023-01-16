<?php

namespace restapi\models;

use common\models\Product;
use restapi\models\CategoryModel;

class ProductModel extends Product
{

    public function getCategory()
    {
        return $this->hasOne(CategoryModel::class, ['id' => 'category_id']);
    }

    public function fields()
    {
        return [
            'id',
            'product_name',
            'amount',
            'every_amount',
            'all_amount',
            'product_purchase_price',
            'currency_price',
            'min_sell_price_retail',
            'max_sell_price_retail',
            'min_sell_price_good',
            'max_sell_price_good',
            'type_of_currency' => function ($model) {
                if ($model->type_of_currency == $model::USD) {
                    return "AQSH dollari";
                } elseif ($model->type_of_currency == $model::EURO) {
                    return "Yevro";
                } elseif ($model->type_of_currency == $model::RUB) {
                    return "RUBL";
                } else {
                    return "SUM";
                }
            },
            'status' => function($model){
                if($model->status == self::STATUS_ACTIVE){
                    return "FAOL";
                } elseif($model->status == self::STATUS_INACTIVE){
                    return "NOFAOL";
                } return "O'CHIRILGAN";
            },
            'created_at'
        ];
    }

    public function extraFields()
    {
        return [
            'category'
        ];
    }
}

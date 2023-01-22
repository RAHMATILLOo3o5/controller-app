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
            'type_of_currency',
            'status',
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

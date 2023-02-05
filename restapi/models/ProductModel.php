<?php

namespace restapi\models;

use backend\models\ProductBackendModel;
use common\models\Selling;
use restapi\models\CategoryModel;

class ProductModel extends ProductBackendModel
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
            'created_at',
            'category_id' => function(){
                return $this->category;
            }
        ];
    }

    public function extraFields()
    {
        return [
            'selling'
        ];
    }

    public function getSelling()
    {
        return $this->hasMany(Selling::class, ['product_id' => 'id']);
    }
}

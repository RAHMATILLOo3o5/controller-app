<?php

namespace restapi\models;

use common\models\ProductCategory;

class CategoryModel extends ProductCategory
{
    public function fields()
    {
        return [
            'id',
            'category_name', 
            'unit' => function($model){
                return ($model->unit == 0) ? "KG" : "DONA";
            },
            'created_at' => function ($model){
                return date('Y-m-d H:i:s', $model->created_at);
            }
        ];
    }

    public function extraFields()
    {
        return [
            'products' => 'product'
        ];
    }

}
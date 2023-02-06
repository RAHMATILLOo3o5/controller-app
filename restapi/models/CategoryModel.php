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
            'unit',
            'created_at',
        ];
    }

    public function extraFields()
    {
        return [    
            'products' => 'product'
        ];
    }

    public function getUnitProduct()
    {
        
    }

}
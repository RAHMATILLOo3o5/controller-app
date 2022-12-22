<?php

namespace backend\models;

use common\models\Product;
use common\models\ProductCategory;

class ProductBackendModel extends Product
{

    public function getCategoryList()
    {
        return ProductCategory::find()->orderBy(['id' => SORT_DESC])->all();
    }
}

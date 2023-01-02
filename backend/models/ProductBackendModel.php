<?php

namespace backend\models;

use common\models\Backlog;
use common\models\Product;
use common\models\ProductCategory;
use common\models\Selling;

class ProductBackendModel extends Product
{

    public function getCategoryList()
    {
        return ProductCategory::find()->orderBy(['id' => SORT_DESC])->all();
    }

    public function getSellingProductAmount()
    {
        $r = Selling::find()->where(['product_id' => $this->id])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    public function getTypeSellAmount()
    {
        $all = $this->getSellingProductAmount();
    }

    public function getBacklogProduct()
    {
        $r = Backlog::find()->where(['product_id' => $this->id])->sum('sell_amount');
    }
}

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


    /**
     * Mahsulotning qancha sotilgani
     */
    public function getSellingProductAmount()
    {
        $r = Selling::find()->where(['product_id' => $this->id])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    public function getBacklogProduct()
    {
        $r = Backlog::find()->where(['product_id' => $this->id])->sum('sell_amount');
    }
    /**
     * Qarzga sotilgan mahsulot hajmi
     */
    public function getDebtProductAmount()
    {
        $r = Selling::find()->where(['product_id' =>  $this->id, 'type_pay' => Selling::PAY_DEBT])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Naqd pulga sotilgan mahsulot hajmi
     */
    public function getCashProductAmount()
    {
        $r = Selling::find()->where(['product_id' =>  $this->id, 'type_pay' => Selling::PAY_CASH])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Plastikka sotilgan mahsulot hajmi
     */
    public function getOnlineProductAmount()
    {
        $r = Selling::find()->where(['product_id' =>  $this->id, 'type_pay' => Selling::PAY_ONLINE])->sum('sell_amount');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Umumiy qancha summa keltirgani
     */

    public function getAllSumm()
    {
        $r = Selling::find()->where(['product_id' =>  $this->id])->sum('sell_price');

        return ($r == null) ? 0 : $r;
    }

    /**
     * Taxminiy keltirishi mumkin bo'lgan summa
     */

    public function getAboutSumm()
    {
       return $this->converd_currency - $this->getAllSumm();
    }
}

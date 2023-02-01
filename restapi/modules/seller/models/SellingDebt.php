<?php

namespace restapi\modules\seller\models;

use yii\base\Model;
use common\models\Debtor;
use common\models\ProductCategory;
use common\models\Product;

class SellingDebt extends Model
{

    public $debtor_id;
    public $category_id;
    public $product_id;
    public $type_sell;
    public $product_amount;
    public $sell_price;
    public $payment_amount = 5;

    public function rules()
    {
        return [
            [['debtor_id', 'category_id', 'product_id', 'type_sell'], 'integer'],
            [['product_amount', 'sell_price', 'payment_amount'], 'number'],
            [['debtor_id', 'category_id', 'product_id', 'type_sell', 'product_amount', 'sell_price'], 'required'],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::class, 'targetAttribute' => ['debtor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function saved()
    {
        
    }

}

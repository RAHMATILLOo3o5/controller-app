<?php

namespace restapi\modules\seller\models;

use common\models\Backlog;
use yii\base\Model;
use common\models\Debtor;
use common\models\ProductCategory;
use common\models\Product;
use common\models\Selling;

class SellingDebt extends Model
{

    public $debtor_id;
    public $category_id;
    public $product_id;
    public $type_sell;
    public $product_amount;
    public $payment_amount = 0;
    public $sell_price;
    public $payment_type = 5;

    public function rules()
    {
        return [
            [['debtor_id', 'category_id', 'product_id', 'type_sell', 'payment_type'], 'integer'],
            [['product_amount', 'sell_price', 'payment_amount', 'sell_price'], 'number'],
            [['debtor_id', 'category_id', 'product_id', 'type_sell', 'product_amount', 'sell_price'], 'required'],
            [['debtor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Debtor::class, 'targetAttribute' => ['debtor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function saved()
    {
        $backlog = new Backlog();
        $selling = new Selling();

        $selling->category_id = $this->category_id;
        $selling->product_id = $this->product_id;
        $selling->sell_price = $this->payment_amount;
        $selling->sell_amount = $this->product_amount;
        $selling->type_sell = $this->type_sell;
        $selling->type_pay = $this->payment_type;
        if ($selling->save()) {
            $backlog->selling_id = $selling->id;
            $backlog->debtor_id = $this->debtor_id;
            $backlog->backlog_amount = $this->sell_price;
            return $backlog->save() ? $backlog->saved() : $backlog->errors;
        } else{
            return $selling->errors;
        }
    }
}

<?php

namespace backend\models;

use common\models\Product;
use yii\base\Model;
use common\models\ProductCategory;

class OneOfProduct extends Model
{
    public $category_id;
    public $product_name;
    public $all_amount;
    public $product_purchase_price;
    public $one_price;
    public $min_sell_price_retail;
    public $max_sell_price_retail;
    public $min_sell_price_good;
    public $max_sell_price_good;


    public function rules()
    {
        return [
            [[
                'category_id',
                'product_name',
                'all_amount',
                'product_purchase_price',
                'one_price',
                'min_sell_price_retail',
                'max_sell_price_retail',
                'min_sell_price_good',
                'max_sell_price_good'
            ], 'required'],
            [[
                'all_amount',
                'product_purchase_price',
                'one_price',
                'min_sell_price_retail',
                'max_sell_price_retail',
                'min_sell_price_good',
                'max_sell_price_good'
            ], 'number'],
            [['product_name'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Katalog',
            'product_name' => 'Mahsulot nomi',
            'one_price' => 'Bitta mahsulot narxi',
            'all_amount' => 'Umumiy miqdori kg/dona',
            'product_purchase_price' => 'Umumiy hisob',
            'min_sell_price_retail' => 'Chakana minimal narxi',
            'max_sell_price_retail' => 'Chakana maksimal narxi',
            'min_sell_price_good' => 'Optom minimal narxi',
            'max_sell_price_good' => 'Optom maksimal narxi',
        ];
    }

    public function save()
    {
        $product = new Product();
        $product->category_id = $this->category_id;
        $product->product_name =  $this->product_name;
        $product->all_amount = $this->all_amount;
        $product->min_sell_price_retail = $this->min_sell_price_retail;
        $product->max_sell_price_retail = $this->max_sell_price_retail;
        $product->min_sell_price_good = $this->min_sell_price_good;
        $product->max_sell_price_good = $this->max_sell_price_good;
        $product->converd_currency = $this->product_purchase_price;
        $product->product_purchase_price = $this->product_purchase_price;
        $product->currency_price = 1;
        $product->status = $product::STATUS_ACTIVE;
        $product->type_of_currency = $product::UZS;
        $product->amount = 0;
        $product->every_amount = 0;

        return $product->save();
    }

    public function getCategoryList()
    {
        return ProductCategory::find()->where(['status'=>1])->orderBy(['id' => SORT_DESC])->all();
    }
}

<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use component\GetCurrency;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $product_name
 * @property int $amount
 * @property int $every_amount
 * @property int $all_amount
 * @property int $product_purchase_price
 * @property int|null $type_of_currency
 * @property float $currency_price
 * @property float $converd_currency
 * @property float $min_sell_price_retail
 * @property float $max_sell_price_retail
 * @property float $min_sell_price_good
 * @property float $max_sell_price_good
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Product extends \yii\db\ActiveRecord
{

    const USD = 1;
    const UZS = 0;
    const RUB = 5;
    const EURO = 10;
    const STATUS_DELETE = 0;
    const STATUS_INACTIVE = 5;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::class
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'product_name',
                'amount',
                'every_amount',
                'all_amount',
                'product_purchase_price',
                'currency_price',
                'min_sell_price_retail',
                'max_sell_price_retail',
                'min_sell_price_good',
                'max_sell_price_good'
            ], 'required'],
            [[
                'amount',
                'every_amount',
                'all_amount',
                'product_purchase_price',
                'type_of_currency',
                'status', 'created_at',
                'updated_at'
            ], 'default', 'value' => null],
            [[
                'amount',
                'every_amount',
                'all_amount',
                'type_of_currency',
                'status',
                'created_at',
                'updated_at',
                'category_id'
            ], 'integer'],
            [[
                'currency_price',
                'min_sell_price_retail',
                'max_sell_price_retail',
                'min_sell_price_good',
                'max_sell_price_good',
                'product_purchase_price',
                'converd_currency'
            ], 'number'],
            [['product_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Katalog',
            'product_name' => 'Mahsulot nomi',
            'amount' => 'Hajmi qop/quti',
            'every_amount' => 'Dona miqdori kg/dona',
            'all_amount' => 'Umumiy miqdori kg/dona',
            'product_purchase_price' => 'Kelish narxi',
            'type_of_currency' => 'Olish valyutasi',
            'currency_price' => 'Valyuta narxi so\'mda',
            'converd_currency' => 'Kelish narxi so\'mda',
            'min_sell_price_retail' => 'Chakana minimal narxi',
            'max_sell_price_retail' => 'Chakana maksimal narxi',
            'min_sell_price_good' => 'Optom minimal narxi',
            'max_sell_price_good' => 'Optom maksimal narxi',
            'status' => 'Holati',
            'created_at' => 'Kelgan vaqti',
            'updated_at' => 'O\'zgartirilgan vaqti',
        ];
    }
    public function attributeHints()
    {
        return [
            'amount' => 'Mahsulotning necha qop yoki qutida ekanligi',
            'every_amount' => 'Har bir qopning og\'irligi yoki qutining hajmi',
            'all_amount' => 'Umumiy necha kg yoki dona ekanligi',
        ];
    }
    public function getCurrencyLabel()
    {
        $response = [
            self::UZS => 'O\'zbek so\'mi',
            self::USD => 'AQSH dollari',
            self::RUB => 'Rossiya rubli',
            self::EURO => 'Yevro',
        ];

        return $response;
    }

    public function getCurrencyFormat()
    {

        if ($this->type_of_currency == self::USD) {
            return "<span class='badge badge-primary'>AQSH dollari</span>";
        } elseif ($this->type_of_currency == self::EURO) {
            return "<span class='badge badge-warning'>Yevro</span>";
        } elseif ($this->type_of_currency == self::RUB) {
            return "<span class='badge badge-info'>RUBL</span>";
        } else {
            return "<span class='badge badge-success'>SUM</span>";
        }
    }
    public function getStatusLabel()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            return "<span class='badge badge-success'>Sotuvda</span>";
        } elseif ($this->status == self::STATUS_INACTIVE) {
            return "<span class='badge badge-warning'>Bazada tugagan</span>";
        } else {
            return "<span class='badge badge-danger'>Mavjud emas!</span>";
        }
    }
    public function getProductPurchasePrice()
    {
        $price = number_format($this->product_purchase_price, 2, '.', ' ');
        if ($this->type_of_currency == static::USD) {
            return $price . ' $';
        } elseif ($this->type_of_currency == static::RUB) {
            return $price . ' ₽';
        } elseif ($this->type_of_currency == static::EURO) {
            return $price . ' €';
        }
        return $price . ' so\'m';
    }
    public function getAmountFormat()
    {
        return number_format($this->amount, 0, '.', ' ');
    }
    public function getEveryAmountFormat()
    {
        return number_format($this->every_amount, 0, '.', ' ');
    }
    public function getAllAmountFormat()
    {
        return number_format($this->all_amount, 0, '.', ' ') . $this->category->unitLabel;
    }
    public function getMinSellPriceRetail()
    {
        return number_format($this->min_sell_price_retail, 2, '.', ' ');
    }
    public function getMaxSellPriceRetail()
    {
        return number_format($this->max_sell_price_retail, 2, '.', ' ');
    }
    public function getMinSellPriceGood()
    {
        return number_format($this->min_sell_price_good, 2, '.', ' ');
    }
    public function getMaxSellPriceGood()
    {
        return number_format($this->max_sell_price_good, 2, '.', ' ');
    }
    public function getCurrencyValue()
    {
        return number_format($this->currency_price, 2, '.', ' ');
    }
    public function getCurrencyConverd()
    {
        return number_format($this->converd_currency, 2, '.', ' ');
    }

    public function setConverdCurrency($amount, $currency_value)
    {
        return $amount * $currency_value;
    }

    public function setCurrency($type)
    {

        if (!isset($_SESSION['currency']['time']) || $_SESSION['currency']['time'] <= time() - 80000) {
            GetCurrency::getCurrentCurrencyValue();
        }
        if ($type == self::USD) {
            return $_SESSION['currency']['usd'];
        } elseif ($type == self::EURO) {
            return $_SESSION['currency']['eur'];
        } elseif ($type == self::RUB) {
            return $_SESSION['currency']['rubl'];
        } else {
            return 1;
        }
    }

    public function getAllMoney()
    {
        $response = self::find()->sum('converd_currency');

        return $response;
    }

    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }
}

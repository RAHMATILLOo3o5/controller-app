<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "selling".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $product_id
 * @property int|null $worker_id
 * @property int $sell_price
 * @property int $sell_amount
 * @property int|null $type_sell
 * @property int|null $type_pay
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ProductCategory $category
 * @property Product $product
 * @property Worker $worker
 */
class Selling extends \yii\db\ActiveRecord
{
    const TYPE_RETAIL = 0; # Optom
    const TYPE_GOOD = 10; # Chakana
    const PAY_ONLINE = 0; # Plastikka
    const PAY_DEBT = 5; # Qarzga
    const PAY_CASH = 10; # Naqd pulga
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'selling';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'worker_id',
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id', 'worker_id', 'sell_price', 'sell_amount', 'type_sell', 'type_pay', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['category_id', 'product_id', 'worker_id', 'sell_price', 'sell_amount', 'type_sell', 'type_pay', 'created_at', 'updated_at'], 'integer'],
            [['category_id', 'product_id', 'sell_price', 'sell_amount'], 'required'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Worker::class, 'targetAttribute' => ['worker_id' => 'id']],
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
            'product_id' => 'Mahsulot nomi',
            'worker_id' => 'Ishchi',
            'sell_price' => 'To\'lov miqdori',
            'sell_amount' => 'Mahsulot miqdori',
            'type_sell' => 'Sotish turi',
            'type_pay' => 'To\'lov turi',
            'created_at' => 'Sotilgan vaqti',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\ProductCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Worker]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\WorkerQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Worker::class, ['id' => 'worker_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\SellingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\SellingQuery(get_called_class());
    }


    public function getSellList()
    {
        $r = [
            self::TYPE_RETAIL => 'CHAKANA',
            self::TYPE_GOOD => 'OPTOM'
        ];

        return $r;
    }


    public function getPayList()
    {
        $r = [
            self::PAY_CASH => 'Naqd pul',
            self::PAY_ONLINE => 'Plastik karta'
        ];

        return $r;
    }

    public function getCategoryList()
    {
        return ProductCategory::find()->orderBy(['id' => SORT_DESC])->where(['status' => 1])->all();
    }

    public function getProductList()
    {
        return Product::find()->orderBy(['id' => SORT_DESC])->where(['status' => Product::STATUS_ACTIVE])->all();
    }

    public function getProductSellPrice($id, $type_sell): array
    {
        $arr = [];
        $product = Product::findOne(['id' => $id]);

        if ($type_sell == self::TYPE_RETAIL) {
            $arr['min'] = $product->min_sell_price_retail;
            $arr['max'] = $product->max_sell_price_retail;
        } else {
            $arr['min'] = $product->min_sell_price_good;
            $arr['max'] = $product->max_sell_price_good;
        }

        return $arr;
    }

    public function getCashPrice()
    {
        $r = self::find()->where(['type_pay' => self::PAY_CASH, 'worker_id' => Yii::$app->user->id])->sum('sell_price');
        if ($r == null) {
            return 0;
        } else {
            return $r;
        }
    }

    public function getOnlinePrice()
    {
        $r = self::find()->where(['type_pay' => self::PAY_ONLINE, 'worker_id' => Yii::$app->user->id])->sum('sell_price');

        if ($r == null) {
            return 0;
        } else {
            return $r;
        }
    }

    public function getAllMoney()
    {
        $r = self::find()->sum('sell_price');

        return ($r != null) ? $r : 0;
    }
}
